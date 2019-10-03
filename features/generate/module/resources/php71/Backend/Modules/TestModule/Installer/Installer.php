<?php

namespace Backend\Modules\TestModule\Installer;

use Backend\Core\Engine\Model;
use Backend\Core\Installer\ModuleInstaller;

final class Installer extends ModuleInstaller
{
    public function install(): void
    {
        $this->addModule('TestModule');

        $this->importLocale(__DIR__ . '/Data/locale.xml');
        $this->configureEntities();
        $this->configureSettings();
        $this->configureBackendNavigation();
        $this->configureBackendRights();
        $this->configureFrontendExtras();
    }

    private function configureEntities(): void
    {
        Model::get('fork.entity.create_schema')->forEntityClasses(
            [
                // [entity_name]::class,
            ]
        );
    }

    private function configureSettings(): void
    {
        // $this->setSetting($this->getModule(), '[setting_name]', [setting_value]);
    }

    private function configureBackendNavigation(): void
    {
        $navigationModulesId = $this->setNavigation(null, 'Modules');
        /* Single menu item template
        $this->setNavigation(
            $navigationModulesId,
            $this->getModule(),
            '[underscored_module_name]/[underscored_entity_name]_index',
            [
                '[underscored_module_name]/[underscored_entity_name]_add',
                '[underscored_module_name]/[underscored_entity_name]_edit'
            ]
        );
        */
        /* Multiple submenu items template
        $navigationModuleId = $this->setNavigation($navigationModulesId, $this->getModule());
        $this->setNavigation(
            $navigationModuleId,
            '[entity1_name]',
            '[underscored_module_name]/[underscored_entity1_name]_index',
            [
                '[underscored_module_name]/[underscored_entity1_name]_add',
                '[underscored_module_name]/[underscored_entity1_name]_edit'
            ]
        );
        $this->setNavigation(
            $navigationModuleId,
            '[entity2_name]',
            '[underscored_module_name]/[underscored_entity2_name]_index',
            [
                '[underscored_module_name]/[underscored_entity2_name]_add',
                '[underscored_module_name]/[underscored_entity2_name]_edit'
            ]
        );
        */
    }

    private function configureBackendRights(): void
    {
        $this->setModuleRights(1, $this->getModule());

        /* template
        $this->setActionRights(1, $this->getModule(), '[entity_name]Add');
        $this->setActionRights(1, $this->getModule(), '[entity_name]Index');
        $this->setActionRights(1, $this->getModule(), '[entity_name]Delete');
        $this->setActionRights(1, $this->getModule(), '[entity_name]Edit');
        */
    }

    private function configureFrontendExtras(): void
    {
        /* Module Action template
        $this->insertExtra($this->getModule(), ModuleExtraType::block(), [label], [action]);
        */
        /* Module Widget template
        $this->insertExtra($this->getModule(), ModuleExtraType::widget(), [label], [action]);
        */
    }
}
