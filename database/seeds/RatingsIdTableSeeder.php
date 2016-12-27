<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;

class RatingsIdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postDataType = \TCG\Voyager\Models\DataType::where('slug', 'posts')->firstOrFail();

        $dataRow = DataRow::firstOrNew(['data_type_id' => $postDataType->id, 'field' => 'rating_id',]);
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'select_dropdown',
                'display_name' => 'rating_id',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
            ])->save();
        }


    }
}
