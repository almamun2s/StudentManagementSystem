<?php
/**
 * Pagination model
 */

class Pager{

    /**
     * current page number
     *
     * @var int
     */
    private $currentPage;

    /**
     * Number of item per page
     *
     * @var int
     */
    private $limit;

    /**
     * The link prefix
     *
     * @var string 
     */
    private $link;

    /**
     * pagination initialization
     *
     * @param int $limit Write how many items you want to show in single page
     */
    public function __construct( $limit = 2 ){
        $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1 ;
        $currentPage = ($currentPage < 1 ) ? 1 : $currentPage;

        $this->currentPage  = $currentPage;
        $this->limit        = $limit;

        $this->link         = ROOT . str_replace('url=','', $_SERVER['QUERY_STRING']);
        $this->link         = !strstr($this->link, 'page=') ? $this->link.'&page=1' : $this->link;

        echo '<pre>';
        var_dump($this->currentPage);
        echo '</pre>';
        
    }

    public function pagination(){

        $offset = ( $this->currentPage - 1 ) * $this->limit;

        return ' limit '. $this->limit . ' offset '. $offset . ' ';
    }

    public function display(){
        ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php if($this->currentPage != 1 ): ?>
                        <li class="page-item"><a class="page-link" href="<?= preg_replace('/page=[0-9]+/', 'page=1', $this->link ) ?>">First</a></li>
                        <li class="page-item"><a class="page-link" href="<?= preg_replace('/page=[0-9]+/', 'page='.($this->currentPage -1 ), $this->link ) ?>">Prev</a></li>
                    <?php endif; ?>
                    <li class="page-item active"><a class="page-link" ><?= $this->currentPage ?></a></li>
                    <li class="page-item"><a class="page-link" href="<?= preg_replace('/page=[0-9]+/', 'page='.($this->currentPage +1 ), $this->link ) ?>"><?= $this->currentPage + 1 ?></a></li>
                </ul>
            </nav>
        <?php

    }
}