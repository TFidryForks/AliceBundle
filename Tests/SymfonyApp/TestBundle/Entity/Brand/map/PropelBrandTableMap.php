<?php

namespace Hautelook\AliceBundle\Tests\SymfonyApp\TestBundle\Entity\Brand\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'propel_brand' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.SymfonyApp.TestBundle.Entity.Brand.map
 */
class PropelBrandTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'SymfonyApp.TestBundle.Entity.Brand.map.PropelBrandTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('propel_brand');
        $this->setPhpName('PropelBrand');
        $this->setClassname('Hautelook\\AliceBundle\\Tests\\SymfonyApp\\TestBundle\\Entity\\Brand\\PropelBrand');
        $this->setPackage('SymfonyApp.TestBundle.Entity.Brand');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 100, null);
        $this->getColumn('name', false)->setPrimaryString(true);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // PropelBrandTableMap
