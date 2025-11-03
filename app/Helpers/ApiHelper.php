<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ApiHelper
{
//    public static function fetchDepartments($id = null)
//    {
//        $client = new Client();
//        try {
//            $response = $client->get('https://main.jdpu.uz/api/v1/departments');
//            if ($id != null) {
//                if ($response->getStatusCode() == 200) {
//                    $data = json_decode($response->getBody(), true);
//                    if (!empty($data)) {
//                        foreach ($data as $department) {
//                            if (isset($department['id']) && $department['id'] == $id) {
//                                return $department;
//                            }
//                        }
//                    }
//                }
//
//            } else {
//                if ($response->getStatusCode() == 200) {
//                    $data = json_decode($response->getBody(), true);
////                Log::info('Departments fetched: ', $data);
//                    return $data ?? [];
//                }
//            }
//        } catch (\Exception $e) {
//            Log::error('Failed to fetch departments: ' . $e->getMessage());
//        }
//
//        return [];
//    }
//
//    public static function fetchEducationYears()
//    {
//        $client = new Client();
//        try {
//            $response = $client->get('https://main.jdpu.uz/api/v1/years');
//
//            if ($response->getStatusCode() == 200) {
//                $data = json_decode($response->getBody(), true);
////                Log::info('Departments fetched: ', $data);
//                return $data ?? [];
//            }
//        } catch (\Exception $e) {
//            Log::error('Failed to fetch departments: ' . $e->getMessage());
//        }
//
//        return [];
//    }
//
//    public static function fetchLibSubjects()
//    {
//        $client = new Client();
//        try {
//            $response = $client->get('https://main.jdpu.uz/api/v1/lib-subjects');
//
//            if ($response->getStatusCode() == 200) {
//                $data = json_decode($response->getBody(), true);
////                Log::info('Departments fetched: ', $data);
//                return $data ?? [];
//            }
//        } catch (\Exception $e) {
//            Log::error('Failed to fetch departments: ' . $e->getMessage());
//        }
//
//        return [];
//    }
}
