<?php

class Page extends Model{

    // GetList
    public function getList($only_published = false){
        $sql = "select * from `pages` where 1";
        if ( $only_published ){
            $sql .= " and is_published = 1";
        }
        return $this->db->query($sql);
    }

    // getPrice from products
    public function getPrice(){
        $sql = "select `id`, `price_from` from `products` ";
        return $this->db->query($sql);
    }

    // GetByAlias
    public function getByAlias($alias){
        $alias = $this->db->escape($alias);
        $sql = "select * from `pages` where `alias` = '{$alias}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    // GetById
    public function getById($id){
        $id = (int)$id;
        $sql = "select * from `pages` where `id` = '{$id}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    //  Get All Categories
    public function getAllCategories(){
        $sql = "select * from `categories` ";
        return $this->db->query($sql);
    }

    //  getAllChildCategories
    public function getAllChildCategories($id){
        $sql = "select * from `categories` where `parent` = '{$id}' ";
        return $this->db->query($sql);
    }

    // getAllProducts
    public function getAllProducts($id){
        $sql = "select * from `products` where `parent_id` = '{$id}' ";
        return $this->db->query($sql);
    }


    // Save
    public function save($data, $id = null){
        if ( !isset($data['alias']) || !isset($data['title']) || !isset($data['content']) ){
            return false;
        }

        $id = (int)$id;
        $alias = $this->db->escape($data['alias']);
        $title = $this->db->escape($data['title']);
        $content = $this->db->escape($data['content']);
        // $content = $data['content'];
        $is_published = isset($data['is_published']) ? 1 : 0;

        if ( !$id ){ // Add new record
            $sql = "
                insert into `pages`
                   set alias = '{$alias}',
                       title = '{$title}',
                       content = '{$content}',
                       is_published = {$is_published}
            ";
        } else { // Update existing record
            $sql = "
                update `pages`
                   set alias = '{$alias}',
                       title = '{$title}',
                       content = '{$content}',
                       is_published = {$is_published}
                   where `id` = {$id}
            ";
        }

        return $this->db->query($sql);
    }


    // Delete
    public function delete($id){
        $id = (int)$id;
        $sql = "delete from `pages` where `id` = {$id}";
        return $this->db->query($sql);
    }


}