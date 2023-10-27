<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php
class category
{
    private $db, $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($catName)
    {
        $catName = $this->fm->validation($catName);

        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if (empty($catName)) {
            $alert = "<span class='error'>Category must be not empty</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_category(catName) VALUES ('$catName')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Insert Category Success</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Category Not Success</span>";
                return $alert;
            }
        }
    }
    public function show_category()
    {
        $query = "select * from tbl_category order by catId asc";
        $result = $this->db->select($query);
        return $result;
    }
    public function getcatbyId($id)
    {
        $query = "select * from tbl_category where catId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_category($catName, $id)
    {
        $catName = $this->fm->validation($catName);
        $id = $this->fm->validation($id);

        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($catName)) {
            $alert = "<span class='error'>Category must be not empty</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_category SET catName='$catName' WHERE catId='$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>Update Category Success</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update Category Not Success</span>";
                return $alert;
            }
        }
    }
    public function del_category($id)
    {
        $query = "DELETE FROM tbl_category WHERE catId='$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Delete Category Success</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Delete Category Not Success</span>";
            return $alert;
        }
    }

    public function show_category_fontend()
    {
        $query = "select * from tbl_category order by catId asc";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_product_by_cat($id)
    {
        $query = "select * from tbl_product where catId = '$id' order by catId asc limit 8";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_name_cat($id)
    {
        $query = "select * from tbl_category where catId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>