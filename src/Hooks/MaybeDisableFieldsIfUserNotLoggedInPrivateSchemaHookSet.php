<?php
namespace PoP\UserRolesACL\Hooks;

use PoP\UserRolesACL\Environment;
use PoP\UserState\Hooks\AbstractMaybeDisableFieldsIfUserNotLoggedInPrivateSchemaHookSet;

class MaybeDisableFieldsIfUserNotLoggedInPrivateSchemaHookSet extends AbstractMaybeDisableFieldsIfUserNotLoggedInPrivateSchemaHookSet
{
    use MaybeDisableFieldsIfConditionPrivateSchemaHookSetTrait;

    protected function enabled(): bool
    {
        if (!parent::enabled()) {
            return false;
        }

        return Environment::userMustBeLoggedInToAccessRolesFields();
    }
}
