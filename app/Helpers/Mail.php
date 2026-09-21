<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    public static function send(string|array $to, string $subject, string $body, array $attachments = []): bool
    {
        $mailerType = $_ENV['MAIL_MAILER'] ?? 'log';
        $recipients = is_array($to) ? $to : array_filter(array_map('trim', explode(',', $to)));

        if ($mailerType === 'log') {
            $logPath = __DIR__ . '/../../storage/logs/mail.log';
            $logDir = dirname($logPath);
            if (!is_dir($logDir)) {
                mkdir($logDir, 0755, true);
            }
            $logContent = "========================================\n";
            $logContent .= "Date: " . date('Y-m-d H:i:s') . "\n";
            $logContent .= "To: " . implode(', ', $recipients) . "\n";
            $logContent .= "Subject: $subject\n";
            $logContent .= "Body:\n" . strip_tags(str_replace('<br>', "\n", $body)) . "\n";
            if (!empty($attachments)) {
                $logContent .= "Attachments: " . implode(', ', array_map(fn($a) => $a['name'] ?? basename($a['path']), $attachments)) . "\n";
            }
            $logContent .= "========================================\n\n";
            file_put_contents($logPath, $logContent, FILE_APPEND);
            return true;
        }

        $mail = new PHPMailer(true);

        try {
            $mail->CharSet = 'UTF-8';
            if ($mailerType === 'smtp') {
                $mail->isSMTP();
                $mail->Host       = $_ENV['MAIL_HOST'] ?? 'smtp.example.com';
                $mail->SMTPAuth   = !empty($_ENV['MAIL_USERNAME']) && $_ENV['MAIL_USERNAME'] !== 'null';
                $mail->Username   = $_ENV['MAIL_USERNAME'] ?? '';
                $mail->Password   = $_ENV['MAIL_PASSWORD'] ?? '';
                $mail->SMTPSecure = ($_ENV['MAIL_ENCRYPTION'] ?? 'tls') === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = $_ENV['MAIL_PORT'] ?? 587;
            } else {
                $mail->isMail();
            }

            $fromAddress = $_ENV['MAIL_FROM_ADDRESS'] ?? 'info@nygtransporte.com.ar';
            $fromName = $_ENV['MAIL_FROM_NAME'] ?? 'NYG Transporte';
            $mail->setFrom($fromAddress, $fromName);
            foreach ($recipients as $recipient) {
                if (filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                    $mail->addAddress($recipient);
                }
            }

            foreach ($attachments as $att) {
                if (isset($att['path'])) {
                    $mail->addAttachment($att['path'], $att['name'] ?? '');
                }
            }

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = self::getEmailTemplate($subject, $body);
            $mail->AltBody = strip_tags(str_replace('<br>', "\n", $body));

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("PHPMailer Error: " . $mail->ErrorInfo);
            return false;
        }
    }

    protected static function getEmailTemplate(string $title, string $contentHtml): string
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <style>
                body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; background-color: #f3f4f6; color: #374151; margin: 0; padding: 20px; }
                .wrapper { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
                .header { background-color: #111827; padding: 20px; text-align: center; color: #ffffff; }
                .content { padding: 30px; line-height: 1.6; }
                .button-container { text-align: center; margin: 30px 0; }
                .btn { background-color: #fbbf24; color: #111827; text-decoration: none; padding: 12px 24px; font-weight: bold; border-radius: 6px; display: inline-block; }
                .footer { font-size: 12px; color: #9ca3af; text-align: center; padding: 20px; background-color: #f9fafb; border-top: 1px solid #e5e7eb; }
            </style>
        </head>
        <body>
            <div class="wrapper">
                <div class="header">
                    <h2 style="margin:0;">NYG Transporte</h2>
                </div>
                <div class="content">
                    ' . $contentHtml . '
                </div>
                <div class="footer">
                    Recibido automáticamente desde el sitio web de NYG Transporte.
                </div>
            </div>
        </body>
        </html>
        ';
    }
}
