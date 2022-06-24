<?php
require_once('config.php');
require_once('mvc/core/Controller.php');
require_once('mvc/models/photography.php');
require_once('mvc/helpers/session_helper.php');

class PhotographyController extends Controller
{

    public function __construct()
    {
        $this->photography = new Photography;
    }

    public function store()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); // filter and validate mutiple value request
        
        $data = [
            'avatar'             => $_FILES['avatar'],
            'detail_image'       => $_FILES['detail_image'],
            'image_name'         => trim($_POST['image_name']),
            'photography_name'   => trim($_POST['photography_name']),
            'credit_team'        => trim($_POST['credit_team']),
            'description'        => trim($_POST['description'])
        ];


        // Validate empty
        if (empty($data['avatar']) || empty($data['detail_image']) || empty($data['image_name']) || empty($data['photography_name'])) {
            flash("import_error", "Please fill out all inputs", "", "message-error mt-5");
            redirect("/" . ROUTE_ADMIN_IMPORT);
        }

        // Validate file
        if(!$this->photography->isFileValid($_FILES['detail_image']) || !$this->photography->isFileValid($_FILES['avatar'])) {
            flash("import_error", "File không hợp lệ.", "", "message-error mt-2 pb-2");
            redirect("/" . ROUTE_ADMIN_IMPORT);
        }

        // Validate similar 
        if ($data['photography_name'] == $this->photography->checkPhotographyByName($data['photography_name'])) {
            flash("import_error", "Tên thí sinh đã tồn tại.", "", "message-error mt-2 pb-2");
            redirect("/" . ROUTE_ADMIN_IMPORT);
        }

        if ($this->photography->store($data)) {
            popupSuccess("modal_success", "Successfully entered information.");
            redirect("/" . ROUTE_ADMIN_IMPORT);
        } else {
            flash("import_error", "ERROR", "", "message-error mt-5");
            redirect("/" . ROUTE_ADMIN_IMPORT);
        }
    }

    public function delete($id = [])
    {
        $lottery = new Photography();
        
        if ($lottery->deletePhoto($id)) {
            popupSuccess("modal_success", "Ticket has been deleted !", "text-success");
            redirect("/" . ROUTE_ADMIN_ALL_PHOTOGRAPHY);
        } else {
            redirect("/" . ROUTE_ADMIN_ALL_PHOTOGRAPHY);
        }
    }
}
