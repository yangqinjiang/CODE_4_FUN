<?php

class UserTest extends PHPUnit_Framework_TestCase {

	const BASE_URL = 'http://user.cengfan7.com';

	//获取我的好友列表
	public function testGetFriend()
	{
		$r = do_get(self::BASE_URL.'/user/friend/124');
		$this->assertTrue($r);
	}

	public function testRelation()
	{
		$r = do_get(self::BASE_URL.'/user/relation/1');
		$this->assertTrue($r);
	}
	public function testLogin()
	{
		$r = do_post(self::BASE_URL.'/user/login');
		$this->assertTrue($r);
	}
}