<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon; // Using Carbon to handle date manipulations
use Illuminate\Support\Facades\DB;



class DashboardController extends Controller
{

    function __construct()
    {
        // $this->middleware(['permission:dashboard_1|dashboard_2|dashboard_3'], ['only' => ['index']]);
    }


    public function index()
    {
        $users=User::paginate('10');
        return view('dashboard.users.index',compact('users'));
    }


    // public function filterStatus(Request $request)
    // {
    //     // Get the selected status from the dropdown
    //     $status = $request->input('status');

    //     // Start the shipment query
    //     $shipments = Shipment::query();

    //     // Apply status filter if a status was selected
    //     if (!empty($status)) {
    //         $shipments->where('status', $status);
    //     }

    //     // Optionally apply additional date filters (e.g., Today, Yesterday, etc.)
    //     // For example, if you are using date ranges or additional filters, you can handle them here.

    //     // Fetch the filtered shipments and count
    //     $shipmentCountStutes = $shipments->count();


    //     $totalShipments = Shipment::count();

    //     $allShipments = Shipment::where('office_code', 140)->count();
    //     $codNumber = Shipment::where('cod', 0.00)->count();
    //     $userCount = User::count();
    //     // Return the data or view with the results
    //     return view('dashboard.index', compact('shipmentCountStutes','totalShipments', 'allShipments', 'codNumber', 'userCount'));
    // }







    // public function countDuplicates()
    // {
    //     // Group shipments by 'tracking_number' and find those with a count greater than 1 (duplicates)
    //     $duplicates = Shipment::select('tracking_number', DB::raw('COUNT(*) as count'))
    //         ->groupBy('tracking_number')
    //         ->having('count', '>', 1)
    //         ->get();

    //     // Get the total number of duplicated shipments (not unique, includes all occurrences)
    //     $totalDuplicateCount = Shipment::select('tracking_number')
    //         ->groupBy('tracking_number')
    //         ->havingRaw('COUNT(*) > 1')
    //         ->count();

    //     // Alternatively, if you want to get the number of duplicated shipment records:
    //     $duplicatedShipmentsCount = Shipment::whereIn('tracking_number', function($query) {
    //             $query->select('tracking_number')
    //                 ->from('shipments')
    //                 ->groupBy('tracking_number')
    //                 ->havingRaw('COUNT(*) > 1');
    //         })->count();

    //     // Return the view with the duplicate count
    //     return view('shipments.duplicates', compact('duplicates', 'duplicatedShipmentsCount', 'totalDuplicateCount'));
    // }



    // public function getShipmentStatistics()
    // {

    //     $totalShipments = Shipment::count();

    //     // 1. Avoid division by zero by checking if total shipments is greater than 0
    //     if ($totalShipments > 0) {

    //         $successfulDeliveries =Shipment::where('status', 'delivered')->count();
    //         $successfulDeliveriesPercentage = ($successfulDeliveries / $totalShipments) * 100;

    //         $undeliveredShipments = Shipment::where('status', 'undelivered')->count();
    //         $undeliveredShipmentsPercentage = ($undeliveredShipments / $totalShipments) * 100;

    //         $shipmentsByStatus = Shipment::select('status', DB::raw('count(*) as total'))
    //             ->groupBy('status')
    //             ->pluck('total', 'status');
    //         $shipmentsByStatusPercentage = $shipmentsByStatus->map(function ($count) use ($totalShipments) {
    //             return ($count / $totalShipments) * 100;
    //         });

    //         $shipmentsByOffice = Shipment::select('office_code', DB::raw('count(*) as total'))
    //             ->groupBy('office_code')
    //             ->pluck('total', 'office_code');
    //         $shipmentsByOfficePercentage = $shipmentsByOffice->map(function ($count) use ($totalShipments) {
    //             return ($count / $totalShipments) * 100;
    //         });

    //         $shipmentsByAttempt = Shipment::select('attempt', DB::raw('count(*) as total'))
    //             ->groupBy('attempt')
    //             ->pluck('total', 'attempt');
    //         $shipmentsByAttemptPercentage = $shipmentsByAttempt->map(function ($count) use ($totalShipments) {
    //             return ($count / $totalShipments) * 100;
    //         });

    //         // Get total COD and average COD
    //         $totalCOD = Shipment::sum('cod');
    //         $averageCOD = Shipment::avg('cod');

    //         // Avoid division by zero for COD values
    //         $averageCODPercentage = $totalCOD > 0 ? ($averageCOD / $totalCOD) * 100 : 0;
    //     } else {
    //         // If no shipments exist, set percentages to 0
    //         $successfulDeliveriesPercentage = $undeliveredShipmentsPercentage = 0;
    //         $shipmentsByStatusPercentage = $shipmentsByOfficePercentage = $shipmentsByAttemptPercentage = collect([]);
    //         $averageCODPercentage = 0;
    //     }

    //     return [
    //         'total_shipments' => $totalShipments,
    //         'successful_deliveries_percentage' => $successfulDeliveriesPercentage,
    //         'undelivered_shipments_percentage' => $undeliveredShipmentsPercentage,
    //         'shipments_by_status_percentage' => $shipmentsByStatusPercentage,
    //         'shipments_by_office_percentage' => $shipmentsByOfficePercentage,
    //         'shipments_by_attempt_percentage' => $shipmentsByAttemptPercentage,
    //         'average_cod_percentage' => $averageCODPercentage
    //     ];
    // }
}
