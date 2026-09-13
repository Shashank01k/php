<?php

namespace App\Controllers\Web\V1\Admin;
use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class UserDeleteController extends BaseController
{
    public function delete($userId)
    {
        $userModel = new User();
        $userDataArray = [
            'deleted_at' => date('Y-m-d H:i:s'),
            'status' => 0,
        ];

        if($userModel->update($userId, $userDataArray)){
            return redirect()->to('admin/index');
        }
    }

    public function deleteAll()
    {
        $selectedValues = $this->request->getPost('checkboxValue');

        if (empty($selectedValues) || !is_array($selectedValues)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'No users selected.'
            ]);
        }

        // Convert IDs to integers
        $selectedValues = array_map('intval', $selectedValues);

        // Logged-in user
        $loggedInUserId = (int) session()->get('id');

        // Prevent deleting own account
        $selectedValues = array_diff($selectedValues, [$loggedInUserId]);

        if (empty($selectedValues)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'You cannot delete your own account.'
            ]);
        }

        $userModel = new User();

        $userModel->whereIn('id', $selectedValues)
            ->delete();

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Users deleted successfully.'
        ]);
    }
}
