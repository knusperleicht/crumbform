<?php

namespace Knusperleicht\CrumbForm\Mail\Boundary;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Knusperleicht\CrumbForm\Mail\Control\MailServiceInterface;

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
        $rules = config($configName . 'rules');
        if (is_null($rules)) {
            return response('Form name not found', 404)
                ->header('Content-Type', 'text/plain');
        } else {
            $input = $request->all();
            if (Validator::make($input, $rules)->fails()) {
                return response('Bad request', 400)
                    ->header('Content-Type', 'text/plain');
            } else {
                $input['configName'] = $configName;
                $this->mailService->send($configName, $input);
            }
        }
    }


}
