<?php
	class Access_model extends TW_Model {
		public function __construct() {
			parent::__construct();
		}

		public function getAccessNames() {
			$res = $this->db->query('SELECT * FROM tblRank');
			return $res->result_array();
		}

        public function hasAccess($playerId, $accessName) {
            if(!$res = $this->db->query('SELECT * FROM tblRank WHERE fcRankCode=?', array($accessName))) return false;
            $res = $res->row_array();
            return $this->hasAccessById($playerId, $res['fnRankID']);
        }   
        
        public function hasAccessById($playerId, $accessId) {
            $res = $this->db->query('SELECT * FROM tblUserRank WHERE fnUserID=? AND fnRankID=?', array($playerId, $accessId));
            return ($res->num_rows() > 0);
        }
	}
