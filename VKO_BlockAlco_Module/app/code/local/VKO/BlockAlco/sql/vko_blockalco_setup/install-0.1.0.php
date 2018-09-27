<?php

$installer = $this;
$installer->startSetup();


$installer->addAttribute('catalog_product', 'forbidden_alcohol', array(
'group'                     => 'General',
'input'                     => 'select',
'type'                      => 'int',
'label'                     => 'forbidden alcohol',
'source'                    => 'eav/entity_attribute_source_boolean',
'global'                    => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
'visible'                   => 1,
'required'                  => 0,
'visible_on_front'          => 1,
'is_html_allowed_on_front'  => 1,
'is_configurable'           => 0,
'filterable'                => 0,
'comparable'                => 0,
'unique'                    => false,
'user_defined'              => false,
'default'                   => 0,
'used_in_product_listing'   => true,
'is_user_defined'           => false
));

$this->endSetup();