<?php


namespace Knusperleicht\CrumbForm\Mail\Control;


use Illuminate\Support\Facades\Mail;

class MailService implements MailServiceInterface
{
    public function send(string $configName, array $input): void
    {
        $cc = array_merge($this->sendCopyTo($configName, $input), config($configName . 'cc') ?? array());
        $from = config($configName . 'from');
        Mail::to($from)
            ->send(new MailSender($from,
                    config($configName . 'subject'),
                    config($configName . 'view'),
                    config($configName . 'bcc'),
                    $cc,
                    $input
                )
            );
    }

    private function sendCopyTo(string $configName, array $input): array
    {
        $copyConfig = config($configName . 'copy');
        $cc = array();
        if (!empty($copyConfig) && count($copyConfig) === 2) {
            if (is_string($copyConfig['field_send_copy'])) {
                if (array_key_exists($copyConfig['field_send_copy'], $input) && array_key_exists($copyConfig['field_email'], $input)) {
                    $cc[] = $input[$copyConfig['field_email']];
                }
            } else if (is_bool($copyConfig['field_send_copy']) && $copyConfig['field_send_copy']) {
                $cc[] = $input[$copyConfig['field_email']];
            }
        }
        return $cc;
    }
}
