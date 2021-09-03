<?php

namespace App\Actions\MemberDomain;


use App\Models\Enquiry;
use App\Models\User;

class CreateEnquiry
{

    public function create(User $user, array $payload)
    {
        $payload['user_id'] = $user->id;

        $enquiry = Enquiry::query()->create($payload);

        event('enquiry.created', $enquiry);

        return $enquiry;
    }

}