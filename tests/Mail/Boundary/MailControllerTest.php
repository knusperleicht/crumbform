<?php


use Illuminate\Support\Facades\Mail;
use Knusperleicht\CrumbForm\CrumbFormServiceProvider;
use Knusperleicht\CrumbForm\Mail\Control\MailSender;
use Orchestra\Testbench\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;


class MailControllerTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        config(['crumbform' => ['knuspiForm' => [
            'view' => 'vendor.crumbform.emails.js',
            'subject' => 'Send from js',
            'from' => ['support@knusperleicht.at'],
            'rules' => [
                'name' => ['required', 'string', 'max:10'],
                'email' => 'required|email'
            ]
        ]]]);
    }

    protected function getPackageProviders($app): array
    {
        return [CrumbFormServiceProvider::class];
    }

    public function test_form_validation_failed(): void
    {
        $response = $this->post('forms/knuspiForm', [
            'name' => 'Knusperleicht',
            'email' => 'testtest.com'
        ]);

        assertNotNull($response);
        assertEquals(400, $response->status());

        $error = json_decode($response->content())->error;
        assertEquals('The name may not be greater than 10 characters.', $error->name[0]);
        assertEquals('The email must be a valid email address.', $error->email[0]);
    }

    public function test_send_mail_success(): void
    {
        Mail::fake();

        $response = $this->post('forms/knuspiForm', [
            'name' => 'Knusperlei',
            'email' => 'test@test.com'
        ]);


        Mail::assertSent(MailSender::class, function ($mail) {
            return $mail->hasTo('support@knusperleicht.at');
        });

        assertNotNull($response);
        assertEquals(200, $response->status());
    }


    public function test_form_config_not_found(): void
    {
        $response = $this->post('forms/formtest', [
            'name' => 'Knusperleicht',
            'email' => 'test@test.com'
        ]);

        assertNotNull($response);
        assertEquals(404, $response->status());
        assertEquals("Config with name formtest not found.", json_decode($response->content())->error);
    }
}
