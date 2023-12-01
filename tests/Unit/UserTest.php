<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testCreateStoreAndRetrieve(): void
    {
        $username = 'new_user';
        $user = new User();
        $user->name = $username;
        $user->password = 'password_hash';
        $user->email = 'user@email';
        $user->save();
        $id = $user->id;

        $userRetrieved = User::findOrFail($id);
        $user->delete();
        $this->assertTrue($userRetrieved->name == $username);
    }
}
