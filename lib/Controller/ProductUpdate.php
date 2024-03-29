<?php

namespace Shop\Controller;

class ProductUpdate extends \Shop\Controller
{
  public function run()
  {
    if ($this->isAdminLoggedIn()) {
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === 'productupdate') {
        $this->updateProduct();
      } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === 'imgdelete') {
        $this->imgDelete();
      }
    } else {
      header('Location: ' . SITE_URL . '/product_all.php');
      exit();
    }
  }

  protected function updateProduct()
  {
    try {
      $this->validate();
    } catch (\Shop\Exception\EmptyPost $e) {
      $this->setErrors('maker', $e->getMessage());
    } catch (\Shop\Exception\EmptyPost $e) {
      $this->setErrors('product_name', $e->getMessage());
    } catch (\Shop\Exception\UnSelected $e) {
      $this->setErrors('category_id', $e->getMessage());
    } catch (\Shop\Exception\InvalidPrice $e) {
      $this->setErrors('price', $e->getMessage());
    } catch (\Shop\Exception\InvalidTags $e) {
      $this->setErrors('tags', $e->getMessage());
    } catch (\Shop\Exception\InvalidDetails $e) {
      $this->setErrors('details', $e->getMessage());
    }
    $this->setValues('maker', $_POST['maker']);
    $this->setValues('product_name', $_POST['product_name']);
    $this->setValues('category_id', $_POST['category_id']);
    $this->setValues('price', $_POST['price']);
    $this->setValues('delflag', $_POST['delflag']);
    // $this->setValues('tag-delete', $_POST['tag-delete']);
    // $this->setValues('tag', $_POST['tag']);
    $this->setValues('details', $_POST['details']);
    if ($this->hasError()) {
      return;
    } else {
      $pro_img = $_FILES['image'];
      $old_img = $_POST['old_image'];
      $ext = substr($pro_img['name'], strrpos($pro_img['name'], '.') + 1);
      $pro_img['name'] = uniqid("img_") . '.' . $ext;
      if ($old_img == '') {
        $old_img = NULL;
      }
      try {
        $createModel = new \Shop\Model\Product();
        if ($pro_img['size'] > 0) {
          unlink('./gazou/' . $old_img);
          move_uploaded_file($pro_img['tmp_name'], './gazou/' . $pro_img['name']);
          $createModel->updatePro([
            'product_name' => $_POST['product_name'],
            'maker' => $_POST['maker'],
            'category_id' => $_POST['category_id'],
            'price' => $_POST['price'],
            'delflag' => $_POST['delflag'],
            'details' => $_POST['details'],
            'image' => $pro_img['name'],
            'id' => $_POST['id']
          ]);
          $pro_img = $pro_img['name'];
          if (isset($_POST['tag_delete'])) {
            $tag_delete = $_POST['tag_delete'];
            foreach ($tag_delete as $val) {
              $createModel->deleteTags([
                'tag_id' => $val['tag_id'],
                'product_id' => $_POST['id'],
              ]);
            }
          }
          $tagsDate = $_POST['tag'];
          foreach ($tagsDate as $tag) {
            $createModel->insertTags([
              'tag_id' => $tag,
              'product_id' => $_POST['id'],
            ]);
          }
        } else {
          $createModel->updatePro([
            'product_name' => $_POST['product_name'],
            'maker' => $_POST['maker'],
            'category_id' => $_POST['category_id'],
            'price' => $_POST['price'],
            'delflag' => $_POST['delflag'],
            'details' => $_POST['details'],
            'image' => $old_img,
            'id' => $_POST['id']
          ]);
          $pro_img = $old_img;
          if (isset($_POST['tag_delete'])) {
            $tag_delete = $_POST['tag_delete'];
            foreach ($tag_delete as $val) {
              $createModel->deleteTags([
                'tag_id' => $val['tag_id'],
                'product_id' => $_POST['id'],
              ]);
            }
          }
          $tagsDate = $_POST['tag'];
          foreach ($tagsDate as $tag) {
            $createModel->insertTags([
              'tag_id' => $tag,
              'product_id' => $_POST['id'],
            ]);
          }
        }
      } catch (\Shop\Exception\DuplicateEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;
      }
    }
    header('Location: ' . SITE_URL . '/product_manage_disp.php?product_id=' . $_POST['id']);
    exit();
  }

  protected function imgDelete()
  {
    $pro_img = $_FILES['image'];
    $old_img = $_POST['old_image'];
    if ($old_img !== '') {
      $userModel = new \Shop\Model\User();
      $userModel->imgDelete();
      unlink('./gazou/' . $old_img);
      $pro_img = NULL;
      header('Location: ' . SITE_URL . '/product_manage.php');
      exit();
    }
  }

  public function getCategories()
  {
    $categories = new \Shop\Model\Product();
    $res = $categories->getCategories();
    return $res;
  }

  private function validate()
  {
    $validate = new \Shop\Controller\Validate();
    $validate->tokenCheck($_POST['token']);
    // $validate->unauthorizedCheck([$_POST['email'], $_POST['username']]);
    // if ($validate->emptycheck($_POST['maker'],$_POST['product_name'],$_POST['price'])) {
    //   throw new \Shop\Exception\EmptyPost("未入力の項目があります!");
    // }
    if ($_POST['maker'] === '') {
      throw new \Shop\Exception\EmptyPost('メーカーが未入力です');
    }
    if ($_POST['product_name'] === '') {
      throw new \Shop\Exception\EmptyPost('商品名が未入力です');
    }
    if ($_POST['price'] === '') {
      throw new \Shop\Exception\EmptyPost('値段が未入力です');
    }
    if (isset($tagsDate)) {
      $getTags = new Shop\Model\Product();
      $tagsToProducts = $getTags->getTagsToProduct($_POST['id']);
      foreach ($tagsDate as $tag) {
        foreach ($tagsToProducts as $ttp) {
          if ($tag->id == $ttp->tag_id) {
            throw new \Shop\Exception\InvalidTags("既に登録済みのタグです！");
          }
        }
      }
    }
  }
}
