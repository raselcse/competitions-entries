<?php

class Competitions_Entries_Deactivator {


	public static function deactivate() {
		if (get_option('competition_list_flushed')) {
			delete_option('competition_list_flushed');
		}
	}

}
