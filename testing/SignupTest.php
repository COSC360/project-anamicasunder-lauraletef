<?php

use PHPUnit\Framework\TestCase;

class SignupTest extends TestCase
{
    public function testValidSignup()
    {
        // Mock POST data
        $_POST = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'password' => 'password'
        ];

        // Mock file upload data
        $_FILES = [
            'userImage' => [
                'name' => 'test.jpg',
                'type' => 'image/jpeg',
                'size' => 50000,
                'tmp_name' => '/tmp/phpABC123'
            ]
        ];

        // Mock database connection
        $connection = $this->getMockBuilder(mysqli::class)
            ->setConstructorArgs(["localhost", "24466963", "24466963", "db_24466963"])
            ->getMock();

        // Mock mysqli_prepare and mysqli_stmt_execute functions
        $stmt = $this->getMockBuilder(mysqli_stmt::class)
            ->setMethods(['bind_param', 'send_long_data', 'execute'])
            ->getMock();

        $stmt->expects($this->at(0))
            ->method('bind_param')
            ->with($this->equalTo("sssss"), $this->equalTo('John'), $this->equalTo('Doe'), $this->equalTo('johndoe'), $this->equalTo('johndoe@example.com'), $this->equalTo(md5('password')));

        $stmt->expects($this->at(1))
            ->method('send_long_data')
            ->with($this->equalTo(2), $this->equalTo(file_get_contents('/tmp/phpABC123')));

        $stmt->expects($this->at(2))
            ->method('execute')
            ->willReturn(true);

        // Mock mysqli_insert_id function
        $connection->expects($this->once())
            ->method('insert_id')
            ->willReturn(123);

        // Mock mysqli_prepare and mysqli_stmt_execute functions for SELECT query
        $select_stmt = $this->getMockBuilder(mysqli_stmt::class)
            ->setMethods(['bind_param', 'execute', 'get_result'])
            ->getMock();

        $select_stmt->expects($this->once())
            ->method('bind_param')
            ->with($this->equalTo("ss"), $this->equalTo('johndoe'), $this->equalTo('johndoe@example.com'));

        $select_stmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $select_stmt->expects($this->once())
            ->method('get_result')
            ->willReturn(new class {
                public function num_rows()
                {
                    return 0;
                }
            });

        // Mock mysqli_prepare and mysqli_stmt_execute functions for INSERT query
        $insert_stmt = $this->getMockBuilder(mysqli_stmt::class)
            ->setMethods(['bind_param', 'execute'])
            ->getMock();

        $insert_stmt->expects($this->once())
            ->method('bind_param')
            ->with($this->equalTo("sssss"), $this->equalTo('John'), $this->equalTo('Doe'), $this->equalTo('johndoe'), $this->equalTo('johndoe@example.com'), $this->equalTo(md5('password')));

        $insert_stmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        // Mock mysqli_prepare function for INSERT query for userImages table
        $user_images_stmt = $this->getMockBuilder(mysqli_stmt::class)
            ->setMethods(['bind_param', 'send_long_data','execute'])
            ->getMock();

            $user_images_stmt->expects($this->once())
            ->method('bind_param')
            ->with($this->equalTo("is"), $this->equalTo(123), $this->equalTo(file_get_contents('/tmp/phpABC123')));
    
        $user_images_stmt->expects($this->once())
            ->method('send_long_data')
            ->with($this->equalTo(1), $this->equalTo(file_get_contents('/tmp/phpABC123')));
    
        $user_images_stmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);
    
        // Mock mysqli_prepare function for SELECT query for userImages table
        $select_image_stmt = $this->getMockBuilder(mysqli_stmt::class)
            ->setMethods(['bind_param', 'execute', 'get_result'])
            ->getMock();
    
        $select_image_stmt->expects($this->once())
            ->method('bind_param')
            ->with($this->equalTo("i"), $this->equalTo(123));
    
        $select_image_stmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);
    
        $select_image_stmt->expects($this->once())
            ->method('get_result')
            ->willReturn(new class {
                public function fetch_assoc()
                {
                    return [                    'image_id' => 456,                    'user_id' => 123,                    'filename' => 'test.jpg',                    'mime_type' => 'image/jpeg',                    'file_size' => 50000,                    'created_at' => '2022-04-06 12:00:00',                    'updated_at' => '2022-04-06 12:00:00'                ];
                }
            });
    
        // Mock mysqli_prepare function for UPDATE query for users table
        $update_stmt = $this->getMockBuilder(mysqli_stmt::class)
            ->setMethods(['bind_param', 'execute'])
            ->getMock();
    
        $update_stmt->expects($this->once())
            ->method('bind_param')
            ->with($this->equalTo("i"), $this->equalTo(123));
    
        $update_stmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        // Call the function that we want to test
$result = updateUserImage($this->mysqli, 123, '/tmp/phpABC123', 'test.jpg', 'image/jpeg', 50000);

// Assert that the function returns true
$this->assertTrue($result);

// Assert that all expected methods were called on the prepared statements
$this->assertMockObjectsHaveBeenVerified();

        }

        public function testUpdateUserImageUserHasNoImage()
{
// Mock mysqli_prepare function for SELECT query for userImages table
$select_image_stmt = $this->getMockBuilder(mysqli_stmt::class)
->setMethods(['bind_param', 'execute', 'get_result'])
->getMock();
$select_image_stmt->expects($this->once())
->method('bind_param')
->with($this->equalTo("i"), $this->equalTo(123));
$select_image_stmt->expects($this->once())
->method('execute')
->willReturn(true);
$select_image_stmt->expects($this->once())
->method('get_result')
->willReturn(false);
// Call the function that we want to test
$result = updateUserImage($this->mysqli, 123, '/tmp/phpABC123', 'test.jpg', 'image/jpeg', 50000);
// Assert that the function returns false
$this->assertFalse($result);
}


public function testUpdateUserImageErrorUpdatingImage()
{
// Mock mysqli_prepare function for INSERT query for userImages table
$user_images_stmt = $this->getMockBuilder(mysqli_stmt::class)
->setMethods(['bind_param', 'send_long_data', 'execute'])
->getMock();
$user_images_stmt->expects($this->once())
->method('bind_param')
->with($this->equalTo("is"), $this->equalTo(123), $this->equalTo(file_get_contents('/tmp/phpABC123')));
$user_images_stmt->expects($this->once())
->method('send_long_data')
->with($this->equalTo(1), $this->equalTo(file_get_contents('/tmp/phpABC123')));
$user_images_stmt->expects($this->once())
->method('execute')
->willReturn(false);
// Call the function that we want to test
$result = updateUserImage($this->mysqli, 123, '/tmp/phpABC123', 'test.jpg', 'image/jpeg', 50000);
// Assert that the function returns false
$this->assertFalse($result);
}

}
           
    
