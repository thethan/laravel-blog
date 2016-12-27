<?php

use TCG\Voyager\Models\DataRow;
use Illuminate\Database\Seeder;

class CategoryIdTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $postDataType = \TCG\Voyager\Models\DataType::where('slug', 'posts')->firstOrFail();

        $dataRow = DataRow::firstOrNew(['data_type_id' => $postDataType->id,'field' => 'category_id',]);
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'category_id',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
            ])->save();
        }
    }
}
