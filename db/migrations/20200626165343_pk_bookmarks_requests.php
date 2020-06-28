<?php

use Phinx\Migration\AbstractMigration;

/* if this crashes and burns, you have duplicates in your database.
 * See: db/migrations/20200626165022_pk_bookmarks_collages.php
 * for a sketch of how to fix.
 */

class PkBookmarksRequests extends AbstractMigration {
    public function up() {
        $this->execute('
            ALTER TABLE bookmarks_requests
                ADD PRIMARY KEY (RequestID, UserID),
                DROP KEY RequestID
        ');
    }
    public function down() {
        $this->execute('
            ALTER TABLE bookmarks_requests
                DROP PRIMARY KEY,
                ADD KEY RequestID (RequestID)
        ');
    }
}
