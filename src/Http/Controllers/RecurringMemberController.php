<?php

namespace Cendekia\FaspayTools\Http\Controllers;

use Cendekia\FaspayTools\Traits\Faspay;
use Illuminate\Http\Request;

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

        return response()->json($memberUpdate);
    }
}
