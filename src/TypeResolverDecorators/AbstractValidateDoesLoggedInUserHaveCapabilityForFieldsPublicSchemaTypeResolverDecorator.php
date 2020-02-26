<?php
namespace PoP\UserRolesACL\Conditional\UserState\TypeResolverDecorators;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\Facades\Schema\FieldQueryInterpreterFacade;
use PoP\AccessControl\TypeResolverDecorators\AbstractPublicSchemaTypeResolverDecorator;
use PoP\UserRolesAccessControl\DirectiveResolvers\ValidateDoesLoggedInUserHaveAnyCapabilityDirectiveResolver;

abstract class AbstractValidateDoesLoggedInUserHaveCapabilityForFieldsPublicSchemaTypeResolverDecorator extends AbstractPublicSchemaTypeResolverDecorator
{
    /**
     * By default, only the admin can see the roles from the users
     *
     * @param TypeResolverInterface $typeResolver
     * @return array
     */
    public function getMandatoryDirectivesForFields(TypeResolverInterface $typeResolver): array
    {
        $mandatoryDirectivesForFields = [];
        if ($capabilities = $this->getCapabilities()) {
            $fieldQueryInterpreter = FieldQueryInterpreterFacade::getInstance();
            // This is the directive to attach
            $validateDoesLoggedInUserHaveAnyCapabilityDirective = $fieldQueryInterpreter->getDirective(
                ValidateDoesLoggedInUserHaveAnyCapabilityDirectiveResolver::getDirectiveName(),
                [
                    'capabilities' => $capabilities,
                ]
            );
            foreach ($this->getFieldNames() as $fieldName) {
                $mandatoryDirectivesForFields[$fieldName] = [
                    $validateDoesLoggedInUserHaveAnyCapabilityDirective,
                ];
            }
        }
        return $mandatoryDirectivesForFields;
    }
    abstract protected function getCapabilities(): array;
    abstract protected function getFieldNames(): array;
}
