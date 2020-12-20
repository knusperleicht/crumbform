<?php

namespace Knusperleicht\CrumbForm\Mail\Boundary;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Knusperleicht\CrumbForm\Mail\Control\MailServiceInterface;
use Knusperleicht\CrumbForm\Platform\ApiResponse;

class MailController extends Controller
{

    private $mailService;

    public function __construct(MailServiceInterface $mailService)
    {
        $this->mailService = $mailService;
    }

    public function validate(Request $request, $id)
    {
        $configName = 'crumbform.' . $id . '.';

        // Validate config name
        $rules = config($configName . 'rules');
        if (is_null($rules)) {
            $error = new ApiResponse(null, 'Config with name ' . $id . ' not found.');
            return response($error->toJson(), 404)
                ->header('Content-Type', 'application/json');
        }

        // Validate form fields
        $input = $request->all();
        $validation = Validator::make($input, $rules);
        if ($validation->fails()) {
            $error = new ApiResponse(null, $validation->errors());
            return response($error->toJson(), 400)
                ->header('Content-Type', 'application/json');
        }

        // Send & maybe save email
        $input['configName'] = $configName;
        $this->mailService->send($configName, $input);

        // Redirect to url
        $redirectTo = config($configName . 'redirect');
        if (!empty($redirectTo)) {
            return redirect($redirectTo);
        }
        return response('Success');
    }
}
