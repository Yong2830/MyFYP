<?php

namespace App\Http\Controllers\advertiser;

use App\Http\Controllers\Controller;
use App\Models\PropertyListing;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function viewSummaryReport(Request $request)
    {
        $advertiserId = auth()->guard('advertiser')->user()->advertiser_id;
        $properties = PropertyListing::where('advertiser_id', $advertiserId)->get();

        $vacantCount = $properties->where('property_rental_status', 'Vacant')->count();
        $rentedCount = $properties->where('property_rental_status', 'Rented')->count();
        $totalCount = $properties->count();

        $fromDate = null; // Set a default value
        $toDate = null; // Set a default value

        return view('advertiser.report.summaryReport', [
            'properties' => $properties,
            'vacantCount' => $vacantCount,
            'rentedCount' => $rentedCount,
            'totalCount' => $totalCount,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }

    public function generateSummaryReport(Request $request)
    {
        $advertiserId = auth()->guard('advertiser')->user()->advertiser_id;
    
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $properties = PropertyListing::where('advertiser_id', $advertiserId)
                    ->whereBetween('property_post_date', [$fromDate, $toDate])->get();

                    
        $vacantCount = $properties->where('property_rental_status', 'Vacant')->count();
        $rentedCount = $properties->where('property_rental_status', 'Rented')->count();
        $totalCount = $properties->count();
        
        if ($request->has('download')) {
            $pdf = Pdf::loadView('advertiser.report.summaryReportPDF', [
                'properties' => $properties,
                'vacantCount' => $vacantCount,
                'rentedCount' => $rentedCount,
                'totalCount' => $totalCount,
                'fromDate' => $fromDate,
                'toDate' => $toDate,
            ])->setPaper('a4', 'landscape');;
    
            return $pdf->download('summary_report.pdf');
        }
    
        return view('advertiser.report.summaryReport', [
            'properties' => $properties,
            'vacantCount' => $vacantCount,
            'rentedCount' => $rentedCount,
            'totalCount' => $totalCount,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }

    public function viewVacancyReport(){
        $advertiserId = auth()->guard('advertiser')->user()->advertiser_id;
        $properties = PropertyListing::where('advertiser_id', $advertiserId)->get();

        $vacantCount = $properties->where('property_rental_status', 'Vacant')->count();
        $rentedCount = $properties->where('property_rental_status', 'Rented')->count();
        $totalCount = $properties->count();

        $highestVacancyState = $properties->groupBy('property_address_state')
        ->sortByDesc(function ($group) {
            return $group->where('property_rental_status', 'Vacant')->count();
        })
        ->keys()
        ->first();

        $fromDate = null; // Set a default value
        $toDate = null; // Set a default value

        return view('advertiser.report.vacancyReport', [
            'properties' => $properties,
            'vacantCount' => $vacantCount,
            'rentedCount' => $rentedCount,
            'totalCount' => $totalCount,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'highestVacancyState' => $highestVacancyState,
        ]);
    }

    public function generateVacancyReport(Request $request)
    {
        $advertiserId = auth()->guard('advertiser')->user()->advertiser_id;
    
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $properties = PropertyListing::where('advertiser_id', $advertiserId)
                    ->whereBetween('property_post_date', [$fromDate, $toDate])->get();

                    
        $vacantCount = $properties->where('property_rental_status', 'Vacant')->count();
        $rentedCount = $properties->where('property_rental_status', 'Rented')->count();
        $totalCount = $properties->count();
        
        $highestVacancyState = $properties->groupBy('property_address_state')
        ->sortByDesc(function ($group) {
            return $group->where('property_rental_status', 'Vacant')->count();
        })
        ->keys()
        ->first();

        if ($request->has('download')) {
            $pdf = Pdf::loadView('advertiser.report.vacancyReportPDF', [
                'properties' => $properties,
                'vacantCount' => $vacantCount,
                'rentedCount' => $rentedCount,
                'totalCount' => $totalCount,
                'fromDate' => $fromDate,
                'toDate' => $toDate,
                'highestVacancyState' => $highestVacancyState,
            ])->setPaper('a4', 'landscape');;
    
            return $pdf->download('vacancy_report.pdf');
        }
    
        return view('advertiser.report.vacancyReport', [
            'properties' => $properties,
            'vacantCount' => $vacantCount,
            'rentedCount' => $rentedCount,
            'totalCount' => $totalCount,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'highestVacancyState' => $highestVacancyState,
        ]);
    }

    public function viewCategoryReport(){
        $advertiserId = auth()->guard('advertiser')->user()->advertiser_id;
        $properties = PropertyListing::where('advertiser_id', $advertiserId)->get();

        $landedCount = $properties->where('property_housing_type', 'Landed')->count();
        $condominiumCount = $properties->where('property_housing_type', 'Condominium')->count();
        $totalCount = $properties->count();

        $highestRentedHousingType = $properties->groupBy('property_housing_type')
        ->sortByDesc(function ($group) {
            return $group->where('property_rental_status', 'Rented')->count();
        })
        ->keys()
        ->first();

        $highestRentedPropertyType = $properties->groupBy('property_type')
        ->sortByDesc(function ($group) {
            return $group->where('property_rental_status', 'Rented')->count();
        })
        ->keys()
        ->first();

        $fromDate = null; // Set a default value
        $toDate = null; // Set a default value

        return view('advertiser.report.categoryReport', [
            'properties' => $properties,
            'landedCount' => $landedCount,
            'condominiumCount' => $condominiumCount,
            'totalCount' => $totalCount,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'highestRentedHousingType' => $highestRentedHousingType,
            'highestRentedPropertyType' => $highestRentedPropertyType,
        ]);
    }

    public function generateCategoryReport(Request $request){
        $advertiserId = auth()->guard('advertiser')->user()->advertiser_id;
        $properties = PropertyListing::where('advertiser_id', $advertiserId)->get();

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $properties = PropertyListing::where('advertiser_id', $advertiserId)
                    ->whereBetween('property_post_date', [$fromDate, $toDate])->get();

        $landedCount = $properties->where('property_housing_type', 'Landed')->count();
        $condominiumCount = $properties->where('property_housing_type', 'Condominium')->count();
        $totalCount = $properties->count();

        $highestRentedHousingType = $properties->groupBy('property_housing_type')
        ->sortByDesc(function ($group) {
            return $group->where('property_rental_status', 'Rented')->count();
        })
        ->keys()
        ->first();

        $highestRentedPropertyType = $properties->groupBy('property_type')
        ->sortByDesc(function ($group) {
            return $group->where('property_rental_status', 'Rented')->count();
        })
        ->keys()
        ->first();

        if ($request->has('download')) {
            $pdf = Pdf::loadView('advertiser.report.categoryReportPDF', [
                'properties' => $properties,
                'landedCount' => $landedCount,
                'condominiumCount' => $condominiumCount,
                'totalCount' => $totalCount,
                'fromDate' => $fromDate,
                'toDate' => $toDate,
                'highestRentedHousingType' => $highestRentedHousingType,
                'highestRentedPropertyType' => $highestRentedPropertyType,
            ])->setPaper('a4', 'landscape');;
    
            return $pdf->download('category_report.pdf');
        }

        return view('advertiser.report.categoryReport', [
            'properties' => $properties,
            'landedCount' => $landedCount,
            'condominiumCount' => $condominiumCount,
            'totalCount' => $totalCount,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'highestRentedHousingType' => $highestRentedHousingType,
            'highestRentedPropertyType' => $highestRentedPropertyType,
        ]);
    }
}
