<?php
require_once 'model/persist/usuario.php';
class UserFilePersist {
    private ?string $filename;
    private ?string $delimiter;

    public function __construct(?string $filename=null,?string $delimiter=null){
        $this->filename=$filename;
        $this->delimiter=$delimiter;
    }

    public function getfilename(){
        return $this->filename;
    }

    public function setfilename($filename) {
        $this->filename = $filename;
    }

    public function getdelimiter(){
        return $this->delimiter;
    }

    public function setdelimiter($delimiter) {
        $this->delimiter = $delimiter;
    }



    /**
 * read all user for files 
 * @return array an array of all users reads from files or ???
 * 
 */
    public function readAllUser():array{
// to do
        $result = array();
        if (\file_exists($this->filename) && \is_readable($this->filename)) {
            $handle = \fopen($this->filename, 'r');  //returns false on error.
            if ($handle!==false) {
                while (!\feof($handle)) {
                    $fields = \fgetcsv($handle,separator: $this->delimiter);
                    if(count($fields) == 2){
                        $uname = $fields[0];
                        $pwd = $fields[1];
                        $user = new User($uname,$pwd);
                        array_push($result,$user);
                    }
                }
                \fclose($handle);     
            }else{
                $result = array();
            }
        }
        return $result;
    }

    /**
 * add user for files 
 * @return array an array of all users reads from files or ???
 * 
 */
    public function addUser(User $user):bool{
        $result = false;
        if (\file_exists($this->filename) && \is_writeable($this->filename)) {
            $handle = \fopen($this->filename, 'a');
            if($handle!=false){
                \fprintf($handle,"%s%s%s\n",$user->getusername(),$this->delimiter,$user->getpassword());
                $result = true;
                \fclose($handle);
            }
        }

        return $result;
        
    }
}
