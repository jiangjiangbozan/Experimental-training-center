<?php
namespace app\index\controller;
use think\Controller;
use think\Response;
use think\Db; // 导入Db类
use app\common\model\Zi; 
use think\Session;  
use think\Request; 
/**
 * 
 */
class ZiController extends Controller
{
    public function index()
    {
        $name = Request::instance()->get('name');
        $Zi = new Zi; 
        if (!empty($name)) {
            $Zi->where('name', 'like', '%' . $name . '%');
        }
        $documents = $Zi::order('id', 'desc')->paginate(5);; // 查询documents表的所有记录
        // 分配数据给视图
        $power = Session::get('power');
    	$this->assign('power',$power);
        $this->assign('documents', $documents);
        // 渲染视图
        return $this->fetch();
    }

    public function storeDocument()
        {
            // 获取文件名或路径
            $filePath = input('get.resum');
            // 文件存放的完整路径
            $file_dir_start = ROOT_PATH .$filePath;
            $url_fix = substr($file_dir_start, 0, strrpos($file_dir_start, "..\\"));
            $url_param = substr($file_dir_start, strrpos($file_dir_start, "..\\") + 3);
            $file_dir_final =$url_fix . $url_param;
            // 安全检查：防止目录遍历攻击
            if (strpos($filePath, '..\\') !== false) {
                $this->error('非法文件请求');
            }
            // 检查文件是否存在
            if (!file_exists($file_dir_final)) {
                $this->error('文件未找到');
            }
            // 读取文件内容
            $file_content = file_get_contents($file_dir_final);
            // 直接获取文件路径存储，不再读取文件内容
            $filePath = input('get.resum'); // 假设这里已经包含了完整的相对或绝对路径
            // 存储文件路径到数据库
            $this->insertFilePath($filePath);
        }

    private function insertFilePath($filePath)
    {
        // 获取文件名作为参考，但实际存储的是路径
        $name = basename($filePath);

        // 只存储文件路径，避免存储大量文件内容到数据库
        $sql = "INSERT INTO documents (name, path) VALUES ('{$name}', '{$filePath}')";

        // 执行 SQL 语句
        $result = Db::execute($sql);

        if ($result !== false) {
            return '文件路径已存入数据库';
        } else {
            return '文件路径存入失败';
        }
    }

    
    public function upload()
    {
        // 判断是否有文件上传
        if (request()->isPost()) {
            $file = request()->file('document');

            // 移动到框架应用根目录/uploads/ 目录下，保持原始文件名并添加时间戳避免重名
            if ($file) {
                // 获取原始文件名和扩展名
                $file = request()->file('document');
                $originalName = $file->getInfo('name');
                $extension = $file->getExtension();
                $newName = $originalName; // 直接使用原始文件名
                // 移动文件
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads', $newName);
                
                if ($info) {
                    // 成功上传后 获取上传信息
                    $fileName = $newName; // 使用带有时间戳的新文件名
                    $filePath = 'uploads/' . $newName; // 完整文件路径用于数据库存储
                    
                    // 调用方法保存文件名和路径到数据库
                    $result = $this->insertFileRecord($fileName, $filePath);

                    if ($result) {
                        // 上传并保存到数据库成功后，显示成功提示并跳转到指定页面
                        return $this->success('文件上传成功', 'index/zi/index');
                    } else {
                        // 保存到数据库失败
                        return $this->error('文件上传成功，但保存到数据库失败');
                    }
                } else {
                    // 上传失败获取错误信息
                    return $file->getError();
                }
            }
        }

        // 显示上传表单
        return $this->fetch();
    }

    private function insertFileRecord($fileName, $filePath)
    {
        // 假设您的表名为yunzhi_documents，包含name（文件名）和path（文件路径）字段
        $data = [
            'name' => $fileName,
            'path' => $filePath,
        ];

        // 插入数据到数据库
        $result = Db::name('zi')->insert($data);

        return $result !== false; // 返回操作是否成功
    }
    public function delete()
    {
        // 从URL参数中获取文件ID
        $documentId = $this->request->param('id'); // TP5
        if (empty($documentId)) {
        // 如果ID为空，可能是请求不合法，返回错误信息
        return $this->error('非法请求，请确保提供了正确的文件ID');
        }
        
        // 确认ID有效且文件记录存在
        if ($documentId && ($document = Zi::get($documentId))) {
            // 构建文件的物理路径
            $filePath = ROOT_PATH . 'public' . DS . $document->path;

            // 尝试从数据库删除记录
            if ($document->delete()) {
                // 删除数据库记录成功，尝试删除物理文件
                if (file_exists($filePath) && unlink($filePath)) {
                    // 物理文件也删除成功，可以重定向到成功页面或返回JSON消息
                    return $this->success('文件已成功删除', 'index/zi/index');
                } else {
                    // 文件删除失败，但数据库记录已删除，需要处理这种情况
                    return $this->error('文件记录已删除，但物理文件删除失败，请检查文件权限');
                }
            } else {
                // 数据库删除失败
                return $this->error('文件删除失败');
            }
        } else {
            // 无效的ID或文件不存在
            return $this->error('非法请求');
        }
    }

}