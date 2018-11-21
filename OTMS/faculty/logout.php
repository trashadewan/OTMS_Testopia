
<?PHP
session_start();
if(isset($_SESSION['id']))
{
unset($_SESSION);
session_destroy();
header('Location:../index.html');
}
?>
