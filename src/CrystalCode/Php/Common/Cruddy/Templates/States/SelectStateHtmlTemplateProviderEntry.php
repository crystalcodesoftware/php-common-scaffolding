<?php

namespace CrystalCode\Php\Common\Cruddy\Templates\States;

use CrystalCode\Php\Common\Cruddy\EntityInterface;
use CrystalCode\Php\Common\Scaffolding\Templates\TemplateProviderEntryBase;
use CrystalCode\Php\Common\Scaffolding\Util\Identifier;
use CrystalCode\Php\Common\Templates\DelegateTemplate;
use CrystalCode\Php\Common\Templates\TemplateInterface;

final class SelectStateHtmlTemplateProviderEntry extends TemplateProviderEntryBase
{

    /**
     * 
     * {@inheritdoc}
     */
    public function getApplicability($values): int
    {
        $total = 0;

        if ($values->entity instanceof EntityInterface) {
            if ($values->state === 'select' && $values->type === 'html') {
                $total += 10;
            }
        }

        return $total;
    }

    /**
     * 
     * {@inheritdoc}
     */
    public function getTemplate($values): TemplateInterface
    {
        return new DelegateTemplate(function () use ($values) {
            $xhtmlPrefix = 'crud';
            $entityName = $values->entity->getName();
            $singleXhtmlEntityName = Identifier::getSingleXhtmlName($entityName);
            $pluralFieldEntityName = Identifier::getPluralFieldName($entityName);
            $pluralXhtmlEntityName = Identifier::getPluralXhtmlName($entityName);

            ?>

            <div class="clearfix"
                 <?= $xhtmlPrefix ?>-<?= $singleXhtmlEntityName ?>-filters
                 on-event="self.handleEvent(event)">
            </div>


            <div class="clearfix"
                 <?= $xhtmlPrefix ?>-<?= $singleXhtmlEntityName ?>-listing
                 <?= $pluralXhtmlEntityName ?>="self.<?= $pluralFieldEntityName ?>" 
                 on-event="self.handleEvent(event)">
            </div>

            <?php

        });
    }

}
