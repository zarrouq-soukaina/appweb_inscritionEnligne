<?php 
class Etudiant {

    private $conn;
    function __construct() {
    session_start();
       $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "inscription";  
        $conn = mysqli_connect($servername, $username, $password, $dbname); 
        if (!$conn) {   die("Connection failed: " . mysqli_connect_error());  } 
        else{
        $this->conn=$conn;  
       }

    }


   
    public function view_etudiant ($etudiant_id){
       if(isset($etudiant_id)){
       $ids= mysqli_real_escape_string($this->conn,trim($etudiant_id));
      
       $sql="Select * from informations where id='$ids'";
        
       $result=  $this->conn->query($sql);
     
        return $result->fetch_assoc(); 
    
       }  
    }
        public function profil_etudiant ($etudiant_id){
       if(isset($etudiant_id)){
       $ids= mysqli_real_escape_string($this->conn,trim($etudiant_id));
      
       $sql="Select * from demandesvalidee where id='$ids'";
        
       $result=  $this->conn->query($sql);
     
        return $result->fetch_assoc(); 
    
       }  
    }


    public function view_deadline ($admin_id){
       if(isset($admin_id)){
       $ids= mysqli_real_escape_string($this->conn,trim($admin_id));
       $sql="Select deadline from admin where idAdmin='$ids'";
        
       $result=  $this->conn->query($sql);
     
        return $result->fetch_assoc(); 
    
       }  
    }
      


    public function updateEtudiant($post_data=array()){
       if(isset($post_data['update_etudiant'])&& isset($post_data['id'])){
       
        $Cycle = mysqli_real_escape_string($this->conn,trim($post_data["cycle"]));
        $Niveau = mysqli_real_escape_string($this->conn,trim($post_data["niveau"]));
       $filiere=mysqli_real_escape_string($this->conn,trim($post_data["filiere"]));
        
        
        
        $etudiant_id= mysqli_real_escape_string($this->conn,trim($post_data['id']));



       
        $sq="UPDATE demandesvalidee SET Cycle='$Cycle',Niveau='$Niveau',Filiere='$filiere' WHERE id =$etudiant_id";
        $res=$this->conn->query($sq);
     
        
           if( $res ){
               $_SESSION['message']="Choix modifiés avec succès";
           }
       unset($post_data['update_etudiant']);
       }   
    }

    public function updatedeadline($post_data=array()){
       if(isset($post_data['update_deadline'])&& isset($post_data['idAdmin'])){
        $deadline =mysqli_real_escape_string($this->conn,trim($post_data["deadline"]));
        $sql="UPDATE admin SET deadline='$deadline'";
        $result=  $this->conn->query($sql);
        if($result ){
               $_SESSION['message']="la date limite est modifiée avec succès ";
           }
       unset($post_data['update_deadline']);
       }   
    }

  }



    ?>

    
