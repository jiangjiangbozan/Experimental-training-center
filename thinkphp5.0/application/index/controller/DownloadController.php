<?php
// application/index/controller/DownloadController.php
namespace app\index\controller;
use think\Controller;
use think\Response;

class DownloadController extends Controller
{
    public function index()
    {

    }

    public function download()
    {
        // 获取文件名或路径
        $filePath =$_GET['resum'];
        // 安全检查：防止目录遍历攻击
        if (strpos($filePath, '../') !== false) {
            $this->error('非法文件请求');
        }
        
        // 文件存放的完整路径
        $file_dir_start = ROOT_PATH . $filePath;
        $url_fix = substr($file_dir_start, 0, strrpos($file_dir_start,"..\\"));
        $url_param = substr($file_dir_start, strrpos($file_dir_start,"..\\")+3);
        $file_dir_final = $url_fix . $url_param;
        
        // 检查文件是否存在
        if (!file_exists($file_dir_final)) {
            $this->error('文件未找到');
        } else {
            // 设置文件名
            $fileName = basename($file_dir_final);
            // 打开文件
            $file1 = fopen($file_dir_final, "r");
            
            // 设置HTTP头信息
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"$fileName\"");
            header("Content-Length: " . filesize($file_dir_final));
            
            // 清空输出缓冲区
            ob_clean();
            
            // 刷新输出缓冲
            flush();
            
            // 输出文件内容
            fpassthru($file1); // 直接输出文件内容，比fread效率高
            
            // 关闭文件
            fclose($file1);
            
            // 终止脚本执行
            exit();
        }
    }

}
