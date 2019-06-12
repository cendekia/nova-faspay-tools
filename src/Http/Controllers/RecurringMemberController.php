<?php

namespace Cendekia\FaspayTools\Http\Controllers;

use Illuminate\Http\Request;
use Cendekia\FaspayTools\Traits\Faspay;
use Illuminate\Support\Facades\Notification;

class RecurringMemberController extends Controller
{
    use Faspay;

    /**
     * check faspay recurring member data.
     *
     * @return Response
     */
    public function check(Request $request, $memberId)
    {
        $memberData = $this->generateSignature($memberId)
            ->generateXml()
            ->execute();

        return response()->json($memberData);
    }

    public function update(Request $request, $memberId)
    {
        $memberUpdate = $this->generateSignature($memberId)
            ->generateXml('update_recurring_member')
            ->execute();

        if ($memberUpdate['response_code'] == 00 && $memberUpdate['response_desc'] == 'Sukses') {
            $this->sendUpdateRecurringStatus($request->member);
        }

        return response()->json($memberUpdate);
    }

    private function sendUpdateRecurringStatus($data)
    {
        if ($data['recurring_status'] == 0) {
            $class = config('faspay.notification_class.stop_recurring');
            Notification::route('slack', config('faspay.notification_channel.slack'))->notify(new $class($data));
        }
    }
}
