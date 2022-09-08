
<?php 
class About extends Controller
{
    public function index()
    {
        require_once 'application/views/_templates/header.php';
        require_once 'application/views/about/index.php';
        require_once 'application/views/_templates/footer.php';
    }
}
