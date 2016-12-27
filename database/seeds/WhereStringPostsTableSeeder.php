<?php

use Illuminate\Database\Seeder;

class WhereStringPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postDataType = \TCG\Voyager\Models\DataType::where('slug', 'posts')->firstOrFail();

        $dataRow = \TCG\Voyager\Models\DataRow::firstOrNew(['data_type_id' => $postDataType->id, 'field' => 'where',]);
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => 'where',
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
