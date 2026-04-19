<?php

// Utilidad de correo del modulo auth.
// Se usa para enviar el codigo de recuperacion de contrasena.
class Mailer {

    // Punto de entrada del envio.
    // Prepara asunto/cuerpo y decide si usar PHPMailer o mail() nativo.
    public static function send_recovery_mail($email, $name, $code) {
        $subject = 'Recuperacion de contrasena - Go Cart';
        $body = self::build_recovery_template($name, $code);
        $autoload = ROOT . 'vendor' . DS . 'autoload.php';

        if (is_readable($autoload)) {
            require_once $autoload;
        }

        if (class_exists('\\PHPMailer\\PHPMailer\\PHPMailer')) {
            self::send_with_phpmailer($email, $name, $subject, $body, $code);
            return;
        }

        self::send_with_native_mail($email, $subject, $body);
    }

    // Envio principal por SMTP usando PHPMailer.
    // Esta ruta es la recomendada para desarrollo y produccion.
    private static function send_with_phpmailer($email, $name, $subject, $body, $code) {
        try {
            $mailerClass = '\\PHPMailer\\PHPMailer\\PHPMailer';
            $mailer = new $mailerClass(true);
            // La configuracion puede venir desde .env
            // o desde la tabla token de la base de datos.
            $mailConfig = self::resolve_mail_config();

            if (($mailConfig['host'] ?? '') !== '') {
                $mailer->isSMTP();
                $mailer->Host = $mailConfig['host'];
                $mailer->Port = (int) $mailConfig['port'];
                $mailer->SMTPAuth = ($mailConfig['username'] ?? '') !== '';
                $mailer->Username = $mailConfig['username'];
                $mailer->Password = $mailConfig['password'];
                $mailer->SMTPSecure = $mailConfig['encryption'];
            }

            $mailer->CharSet = 'UTF-8';
            $mailer->setFrom($mailConfig['from_address'], $mailConfig['from_name']);
            $mailer->addAddress($email, $name);
            $mailer->isHTML(true);
            $mailer->Subject = $subject;
            $mailer->Body = $body;
            $mailer->AltBody = 'Tu codigo de recuperacion es: ' . $code;
            $mailer->send();
        } catch (Throwable $exception) {
            throw new Exception('No se pudo enviar el correo de recuperacion: ' . $exception->getMessage());
        }
    }

    // Resuelve la configuracion de correo con prioridad:
    // 1. variables de entorno
    // 2. tabla token
    private static function resolve_mail_config() {
        $config = [
            'host' => MAIL_HOST,
            'port' => MAIL_PORT,
            'username' => MAIL_USERNAME,
            'password' => MAIL_PASSWORD,
            'encryption' => MAIL_ENCRYPTION,
            'from_address' => MAIL_FROM_ADDRESS,
            'from_name' => MAIL_FROM_NAME
        ];

        if (($config['host'] ?? '') !== '') {
            return $config;
        }

        $databaseConfig = self::get_database_mail_config();

        if (!$databaseConfig) {
            return $config;
        }

        $config['host'] = trim((string) ($databaseConfig['host'] ?? ''));
        $config['username'] = trim((string) ($databaseConfig['email'] ?? ''));
        $config['password'] = self::decode_secret((string) ($databaseConfig['password'] ?? ''));

        if ($config['from_address'] === '' || $config['from_address'] === 'no-reply@gocart.local') {
            $config['from_address'] = $config['username'];
        }

        return $config;
    }

    // Lee el fallback de correo guardado en la base.
    private static function get_database_mail_config() {
        $modelPath = APP_PATH . 'models' . DS . 'M_MailConfig.php';

        if (!is_readable($modelPath)) {
            return null;
        }

        require_once $modelPath;
        $mailConfigModel = new M_MailConfig();

        return $mailConfigModel->get_mail_settings();
    }

    // Algunas contrasenas del dump vienen con entidades HTML;
    // este metodo las limpia antes de usarlas.
    private static function decode_secret($secret) {
        $decoded = $secret;

        for ($i = 0; $i < 3; $i++) {
            $next = html_entity_decode($decoded, ENT_QUOTES | ENT_HTML5, 'UTF-8');

            if ($next === $decoded) {
                break;
            }

            $decoded = $next;
        }

        return $decoded;
    }

    // Fallback simple para entornos donde PHPMailer no este disponible.
    // En local suele no ser suficiente, por eso el camino recomendado es SMTP.
    private static function send_with_native_mail($email, $subject, $body) {
        $headers = [
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=UTF-8',
            'From: ' . MAIL_FROM_NAME . ' <' . MAIL_FROM_ADDRESS . '>'
        ];

        $sent = mail($email, $subject, $body, implode("`r`n", $headers));

        if (!$sent) {
            throw new Exception('No se pudo enviar el correo. Instala y configura PHPMailer o habilita mail().');
        }
    }

    // Plantilla HTML del correo de recuperacion.
    private static function build_recovery_template($name, $code) {
        $safeName = htmlspecialchars((string) $name, ENT_QUOTES, 'UTF-8');
        $safeCode = htmlspecialchars((string) $code, ENT_QUOTES, 'UTF-8');

        return '
            <div style="font-family: Arial, sans-serif; max-width: 560px; margin: 0 auto; padding: 24px; color: #1f2937;">
                <h2 style="margin-bottom: 12px;">Recuperacion de contrasena</h2>
                <p>Hola ' . $safeName . ',</p>
                <p>Usa el siguiente codigo para restablecer tu contrasena en Go Cart:</p>
                <div style="font-size: 32px; font-weight: 700; letter-spacing: 6px; padding: 16px 20px; margin: 20px 0; background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 12px; text-align: center;">
                    ' . $safeCode . '
                </div>
                <p>Este codigo vence en 15 minutos.</p>
                <p>Si no solicitaste este cambio, puedes ignorar este mensaje.</p>
            </div>
        ';
    }
}
