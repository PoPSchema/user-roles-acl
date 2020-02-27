<?php
namespace PoP\UserRolesACL\Hooks;

use PoP\UserRolesACL\Environment;
use PoP\UserRolesAccessControl\Hooks\AbstractMaybeDisableFieldsIfLoggedInUserDoesNotHaveRolePrivateSchemaHookSet;

class MaybeDisableFieldsIfLoggedInUserDoesNotHaveRolePrivateSchemaHookSet extends AbstractMaybeDisableFieldsIfLoggedInUserDoesNotHaveRolePrivateSchemaHookSet
{
    use MaybeDisableFieldsIfConditionPrivateSchemaHookSetTrait;

    protected function getRoleNames(): array
    {
        return Environment::anyRoleLoggedInUserMustHaveToAccessRolesFields();
    }
}
