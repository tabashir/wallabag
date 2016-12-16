<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Version20161117071626 extends AbstractMigration implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function getTable($tableName)
    {
        return $this->container->getParameter('database_table_prefix').$tableName;
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('INSERT INTO '.$this->getTable('craue_config_setting')." (name, value, section) VALUES ('share_unmark', 0, 'entry')");
        $this->addSql('INSERT INTO '.$this->getTable('craue_config_setting')." (name, value, section) VALUES ('unmark_url', 'https://unmark.it', 'entry')");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DELETE FROM '.$this->getTable('craue_config_setting')." WHERE name = 'share_unmark';");
        $this->addSql('DELETE FROM '.$this->getTable('craue_config_setting')." WHERE name = 'unmark_url';");
    }
}