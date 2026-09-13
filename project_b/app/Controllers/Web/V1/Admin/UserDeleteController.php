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
        $data = $this->request->getJSON(true);

        $selectedValues = $data['checkboxValue'] ?? [];

        if (empty($selectedValues)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'No users selected'
            ]);
        }

        // Logged-in admin
        $loggedInUserId = session()->get('id');

        return $this->response->setJSON([
            'status'       => true,
            'message'      => 'deleteAll method executed successfully',
            'selected_ids' => $selectedValues,
            'deleted_by'   => $loggedInUserId
        ]);
    }
}
