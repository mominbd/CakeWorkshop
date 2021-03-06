<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'primary'),
		'group_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'gender_id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'index'),
		'occupation_id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'index'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'title' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'firstname' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'lastname' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'department_id' => array('type' => 'biginteger', 'null' => true, 'default' => null, 'key' => 'index'),
		'hrz' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'phone' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'hash' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'email_confirmed' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'email_update' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'active' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'notes' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'idx_unique_email' => array('column' => 'email', 'unique' => 1),
			'fk_users_genders_idx' => array('column' => 'gender_id', 'unique' => 0),
			'fk_attendees_departments_idx' => array('column' => 'department_id', 'unique' => 0),
			'idx_hash' => array('column' => 'hash', 'unique' => 0),
			'fk_users_groups_idx' => array('column' => 'group_name', 'unique' => 0),
			'fk_users_occupations_idx' => array('column' => 'occupation_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'group_name' => 'attendee',
			'gender_id' => '',
			'occupation_id' => '',
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'title' => 'Lorem ipsum dolor sit amet',
			'firstname' => 'Lorem ipsum dolor sit amet',
			'lastname' => 'Lorem ipsum dolor sit amet',
			'department_id' => '',
			'hrz' => 'Lorem ipsum dolor sit amet',
			'phone' => 'Lorem ipsum dolor sit amet',
			'hash' => 'Lorem ipsum dolor sit amet',
			'email_confirmed' => 1,
			'email_update' => 'Lorem ipsum dolor sit amet',
			'active' => 'Lorem ipsum dolor sit amet',
			'notes' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2013-05-13 23:06:45'
		),
	);

}
