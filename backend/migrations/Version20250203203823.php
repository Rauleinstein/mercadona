<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250203203823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ingredient_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE recipe_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE recipe_ingredient_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE shopping_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE shopping_list_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, icon VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN category.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN category.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE ingredient (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, unit VARCHAR(50) NOT NULL, nutritional_info JSON DEFAULT NULL, base_price NUMERIC(10, 2) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN ingredient.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN ingredient.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE recipe (id INT NOT NULL, author_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, preparation_time INT NOT NULL, cooking_time INT NOT NULL, servings INT NOT NULL, difficulty VARCHAR(50) NOT NULL, instructions TEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DA88B137F675F31B ON recipe (author_id)');
        $this->addSql('COMMENT ON COLUMN recipe.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN recipe.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE recipe_category (recipe_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(recipe_id, category_id))');
        $this->addSql('CREATE INDEX IDX_70DCBC5F59D8A214 ON recipe_category (recipe_id)');
        $this->addSql('CREATE INDEX IDX_70DCBC5F12469DE2 ON recipe_category (category_id)');
        $this->addSql('CREATE TABLE recipe_ingredient (id INT NOT NULL, recipe_id INT NOT NULL, ingredient_id INT NOT NULL, quantity NUMERIC(10, 2) NOT NULL, unit VARCHAR(50) NOT NULL, notes VARCHAR(255) DEFAULT NULL, optional BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_22D1FE1359D8A214 ON recipe_ingredient (recipe_id)');
        $this->addSql('CREATE INDEX IDX_22D1FE13933FE08C ON recipe_ingredient (ingredient_id)');
        $this->addSql('CREATE TABLE shopping_list (id INT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3DC1A459A76ED395 ON shopping_list (user_id)');
        $this->addSql('COMMENT ON COLUMN shopping_list.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN shopping_list.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE shopping_list_item (id INT NOT NULL, shopping_list_id INT NOT NULL, ingredient_id INT NOT NULL, quantity NUMERIC(10, 2) NOT NULL, unit VARCHAR(50) NOT NULL, purchased BOOLEAN NOT NULL, notes VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4FB1C22423245BF9 ON shopping_list_item (shopping_list_id)');
        $this->addSql('CREATE INDEX IDX_4FB1C224933FE08C ON shopping_list_item (ingredient_id)');
        $this->addSql('COMMENT ON COLUMN shopping_list_item.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN shopping_list_item.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, name VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE user_favorite_recipes (user_id INT NOT NULL, recipe_id INT NOT NULL, PRIMARY KEY(user_id, recipe_id))');
        $this->addSql('CREATE INDEX IDX_83280E06A76ED395 ON user_favorite_recipes (user_id)');
        $this->addSql('CREATE INDEX IDX_83280E0659D8A214 ON user_favorite_recipes (recipe_id)');
        $this->addSql('CREATE TABLE user_followers (user_source INT NOT NULL, user_target INT NOT NULL, PRIMARY KEY(user_source, user_target))');
        $this->addSql('CREATE INDEX IDX_84E870433AD8644E ON user_followers (user_source)');
        $this->addSql('CREATE INDEX IDX_84E87043233D34C1 ON user_followers (user_target)');
        $this->addSql('CREATE TABLE user_following (user_source INT NOT NULL, user_target INT NOT NULL, PRIMARY KEY(user_source, user_target))');
        $this->addSql('CREATE INDEX IDX_715F00073AD8644E ON user_following (user_source)');
        $this->addSql('CREATE INDEX IDX_715F0007233D34C1 ON user_following (user_target)');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_category ADD CONSTRAINT FK_70DCBC5F59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_category ADD CONSTRAINT FK_70DCBC5F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE1359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE13933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shopping_list ADD CONSTRAINT FK_3DC1A459A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shopping_list_item ADD CONSTRAINT FK_4FB1C22423245BF9 FOREIGN KEY (shopping_list_id) REFERENCES shopping_list (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shopping_list_item ADD CONSTRAINT FK_4FB1C224933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_favorite_recipes ADD CONSTRAINT FK_83280E06A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_favorite_recipes ADD CONSTRAINT FK_83280E0659D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_followers ADD CONSTRAINT FK_84E870433AD8644E FOREIGN KEY (user_source) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_followers ADD CONSTRAINT FK_84E87043233D34C1 FOREIGN KEY (user_target) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_following ADD CONSTRAINT FK_715F00073AD8644E FOREIGN KEY (user_source) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_following ADD CONSTRAINT FK_715F0007233D34C1 FOREIGN KEY (user_target) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ingredient_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE recipe_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE recipe_ingredient_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE shopping_list_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE shopping_list_item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE recipe DROP CONSTRAINT FK_DA88B137F675F31B');
        $this->addSql('ALTER TABLE recipe_category DROP CONSTRAINT FK_70DCBC5F59D8A214');
        $this->addSql('ALTER TABLE recipe_category DROP CONSTRAINT FK_70DCBC5F12469DE2');
        $this->addSql('ALTER TABLE recipe_ingredient DROP CONSTRAINT FK_22D1FE1359D8A214');
        $this->addSql('ALTER TABLE recipe_ingredient DROP CONSTRAINT FK_22D1FE13933FE08C');
        $this->addSql('ALTER TABLE shopping_list DROP CONSTRAINT FK_3DC1A459A76ED395');
        $this->addSql('ALTER TABLE shopping_list_item DROP CONSTRAINT FK_4FB1C22423245BF9');
        $this->addSql('ALTER TABLE shopping_list_item DROP CONSTRAINT FK_4FB1C224933FE08C');
        $this->addSql('ALTER TABLE user_favorite_recipes DROP CONSTRAINT FK_83280E06A76ED395');
        $this->addSql('ALTER TABLE user_favorite_recipes DROP CONSTRAINT FK_83280E0659D8A214');
        $this->addSql('ALTER TABLE user_followers DROP CONSTRAINT FK_84E870433AD8644E');
        $this->addSql('ALTER TABLE user_followers DROP CONSTRAINT FK_84E87043233D34C1');
        $this->addSql('ALTER TABLE user_following DROP CONSTRAINT FK_715F00073AD8644E');
        $this->addSql('ALTER TABLE user_following DROP CONSTRAINT FK_715F0007233D34C1');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE recipe_category');
        $this->addSql('DROP TABLE recipe_ingredient');
        $this->addSql('DROP TABLE shopping_list');
        $this->addSql('DROP TABLE shopping_list_item');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_favorite_recipes');
        $this->addSql('DROP TABLE user_followers');
        $this->addSql('DROP TABLE user_following');
    }
}
