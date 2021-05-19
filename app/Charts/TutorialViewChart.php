<?php
    
declare(strict_types = 1);

namespace App\Charts;

use App\Models\TutorialView;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class TutorialViewChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        if (request('mode') == 'daily') {
            return $this->buildChartForDailyMode();
        }

        if (request('mode') == 'monthly') {
            return $this->buildChartForMonthlyMode();
        }
    }
    
    protected function buildChartForDailyMode()
    {
        return Chartisan::build()
            ->labels($this->prepareDaysLabels())
            ->dataset('Daily Views', $this->prepareDataset());
    }

    protected function prepareDaysLabels()
    {
        return [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];
    }

    protected function prepareDataset()
    {
        $dataset = [];
        foreach ($this->prepareDaysLabels() as $day) {
            $dataset[] = TutorialView::whereDate('created_at', date("Y-m-$day"))->count();
        }
        return $dataset;
    }

    protected function buildChartForMonthlyMode()
    {
        return Chartisan::build()
            ->labels($this->prepareMonthsLabels())
            ->dataset('Monthly Views', $this->prepareDatasetForMonths());
    }

    protected function prepareMonthsLabels()
    {
        return [1,2,3,4,5,6,7,8,9,10,11,12];
    }

    protected function prepareDatasetforMonths()
    {
        $dataset = [];
        foreach ($this->prepareMonthsLabels() as $month) {
            $dataset[] = TutorialView::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', $month)
            ->count();
        }
        return $dataset;
    }
}
