$this->load->dbutil();
		if (!$this->dbutil->database_exists('beats_assess')){
			$this->load->dbforge();
			$this->dbforge->create_database('beats_assess');
			echo 'Database created!';
		}
		else{
			$this->load->dbforge($this->load->database('assess', TRUE));
			echo 'Database exist!';
		}
		$fields = array(
		        'userid' => array(
		                'type' => 'INT',
		                'constraint' => 9,
		                'unsigned' => TRUE,
		                'auto_increment' => TRUE
		        ),
		        'username' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '32',
		                'unique' => TRUE,
		        ),
		        'password' => array(
		                'type' =>'VARCHAR',
		                'constraint' => '32'
		        ),
		        'level' => array(
		                'type' =>'VARCHAR',
		                'constraint' => '32'
		        )
		);
		$attributes = array('ENGINE' => 'InnoDB');
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('userid', TRUE);
		$this->dbforge->create_table('users', TRUE, $attributes);

		$fields = array(
		        'id' => array(
		                'type' => 'INT',
		                'constraint' => 9,
		                'unsigned' => TRUE,
		                'auto_increment' => TRUE
		        ),
		        'username' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '32',
		                'unique' => TRUE,
		        ),
		        'password' => array(
		                'type' =>'VARCHAR',
		                'constraint' => '32'
		        )
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('users', TRUE, $attributes);