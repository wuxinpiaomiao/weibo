<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {

    public function uploadPic(){
    			$upload = $this->_upload('Pic',array('jpg','gif','png','jpeg'),10485760,array('800','380','120'));
                echo json_encode($upload);
    }

    public function uploadMV(){

    }


    protected function _upload($path,$type,$size,$width){
    	// 实例化上传类
    	$upload = new \Think\Upload();
    	$upload->maxSize = $size;
    	// 设置文件上传类型
    	$upload->exts = $type;
    	// 设置保存路径
        $upload->rootPath = './Public';
    	$upload->savePath = '/Uploads/'.$path.'/';
    	// 开启子目录保存 并以日期(格式为Y-m-d)为子目录
    	$upload->autoSub = true;
    	$upload->subName = array('date','Y-m-d');    
    	$info = $upload->upload();
    	if(!$info){
            $msg = $upload->getError();
    		return array(
                'status' => 0,
                'msg' => $msg
                );
    	}else{
    		$path = $upload->rootPath.$info['Filedata']['savepath'].$info['Filedata']['savename'];
            $path_l = $upload->rootPath.$info['Filedata']['savepath'];
            $path_r = $info['Filedata']['savename'];
            // 生成缩略图
            if(!empty($width)){
                $img = new \Think\Image(); 
                $img->open($path);
                $qz = array('max_','medium_','mini_');
                for( $i = 0; $i< count($width); $i++){
                    $img->thumb($width[$i],$width[$i])->save($path_l.$qz[$i].$path_r);
                }
                unlink($path); //删除原图
            }
            $path =array(
               'max' => $info['Filedata']['savepath'].$qz['0'].$info['Filedata']['savename'],
               'medium' => $info['Filedata']['savepath'].$qz['1'].$info['Filedata']['savename'],
               'mini' => $info['Filedata']['savepath'].$qz['2'].$info['Filedata']['savename']
                );
            // $path = var_dump($info);   
    		return array(
                'status' => 1,
                'path' => $path
                );
    	}


    }
}