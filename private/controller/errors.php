<?php 
/**
 * Error Controller
 */
class Errors extends Controller{
    /**
     * Error page
     *
     * @param integer $errorCode
     */
    public function index( $errorCode = 404 ){
        if ($errorCode == 403 ) {
            $this->view('404', [
                'code'  => $errorCode,
                'error' => 'Unauthorized access'
            ]);
        }elseif ($errorCode == 404 ) {
            $this->view('404', [
                'code'  => $errorCode,
                'error' => 'Page not found'
            ]);
        }else {
            $this->view('404', [
                'code'  => $errorCode,
                'error' => 'Error Code not Found'
            ]);
        }
    }
}