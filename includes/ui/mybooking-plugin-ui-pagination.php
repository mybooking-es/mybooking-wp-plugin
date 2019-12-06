<?php

  class MyBookingUIPagination {

     public function pages($total_pages, $current_page) {

          if ( $total_pages < 10) {
            $first = 1;
            $last = $total_pages;
          }
          else {
            $left = $current_page - 1;
            $right = $total_pages - $current_page;
            if ($left < 5) {
              $first = 1;
            }
            else {
            	$first = $current_page - 4;
            }
            if ($right < 5) {
              $first = $total_pages - 9;
              $last = $total_pages;
            }
            else {
            	$last = $first + 9;
            }
          }
          $pages = [];
          for ($page = $first; $page <= $last; $page++) {
            $pages[] = $page; 
          }

          return $pages;

     }

  }
?>