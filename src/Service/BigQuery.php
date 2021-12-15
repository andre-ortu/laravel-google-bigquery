<?php
namespace AndreOrtu\LaravelGoogleBigQuery\Service;

use AndreOrtu\LaravelGoogleBigQuery\Exceptions\BigQueryInvalidRowException;
use Google\Cloud\BigQuery\BigQueryClient;
use Illuminate\Support\Facades\Log;

class BigQuery
{
    protected $projectId;
    protected $datasetId;
    protected $dataset;
    protected $bigQuery;

    public function __construct($projectId, $datasetId)
    {
        $this->projectId = $projectId;
        $this->datasetId = $datasetId;
        $this->bigQuery = new BigQueryClient([
            'projectId' => $this->projectId,
            'keyFilePath' => config('google_bigquery.credentials')
        ]);

        $this->dataset = $this->bigQuery->dataset($this->datasetId);
    }

    public function insertRows($tableId, $data)
    {
        $table = $this->dataset->table($tableId);

        //formato $data = [['data' => $row1], ['data' => $row2]...['data' => $rowN]];
        $insertResponse = $table->insertRows($data);

        if (! $insertResponse->isSuccessful()) {
            foreach ($insertResponse->failedRows() as $row) {
                foreach ($row['errors'] as $error) {
                    Log::error($error['reason'] . ":" .$error['message']);
                    throw new BigQueryInvalidRowException();
                }
            }
        }
    }

}
