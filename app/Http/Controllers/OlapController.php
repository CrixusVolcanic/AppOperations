<?php

namespace AppOperations\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OlapController extends Controller
{

    private $sql = "";


    public function getDbArrived(Request $request)
    {

        if ($request->ajax()) {
            if (!is_null($request->condition)) {
                foreach ($request->condition as $condition) {
                    $this->sql = $this->sql . $condition . " and ";
                }
                $this->sql = substr($this->sql, 0, strlen($this->sql) - 5);
                $this->sql = 'select count(1) cant from tbl_olap where ' . $this->sql;
            } else {
                $this->sql = 'select count(1) cant from tbl_olap';
            }
            $dbArrivals = DB::select($this->sql);
            return $dbArrivals[0]->cant;
        }
    }

    public function getDbProcessed(Request $request)
    {
        if ($request->ajax()) {
            if (!is_null($request->condition)) {
                foreach ($request->condition as $condition) {
                    $this->sql = $this->sql . $condition . " and ";
                }
                $this->sql = substr($this->sql, 0, strlen($this->sql) - 5);
                $this->sql = 'select count(1) cant from tbl_olap where fecha_carga is not null and ' . $this->sql;
            } else {
                $this->sql = 'select count(1) cant from tbl_olap where fecha_carga is not null';
            }
            $dbProcesseds = DB::select($this->sql);
            return $dbProcesseds[0]->cant;
        }
    }

    public function getDbInProgress(Request $request)
    {
        if ($request->ajax()) {

            if (!is_null($request->condition)) {
                foreach ($request->condition as $condition) {
                    $this->sql = $this->sql . $condition . " and ";
                }
                $this->sql = substr($this->sql, 0, strlen($this->sql) - 5);
                $this->sql = 'select count(1) cant from tbl_olap where fecha_carga is null and ' . $this->sql;
            } else {
                $this->sql = 'select count(1) cant from tbl_olap where fecha_carga is null';
            }
            $dbInProgress = DB::select($this->sql);
            return $dbInProgress[0]->cant;
        }
    }

    public function getPrEfficiency(Request $request)
    {
        if ($request->ajax()) {
            if (!is_null($request->condition)) {
                foreach ($request->condition as $condition) {
                    $this->sql = $this->sql . $condition . " and ";
                }
                $this->sql = substr($this->sql, 0, strlen($this->sql) - 5);
                $this->sql = 'select cast(count(fecha_carga)/count(1) * 100 as DECIMAL(13,2)) as porc from tbl_olap where ' . $this->sql;
            } else {
                $this->sql = 'select cast(count(fecha_carga)/count(1) * 100 as DECIMAL(13,2)) as porc from tbl_olap';
            }

            $prEfficiency = DB::select($this->sql);
            return $prEfficiency[0]->porc . "%";
        }
    }

    public function getFltProduct(Request $request)
    {
        if ($request->ajax()) {
            $products = DB::table('tbl_olap')->select('producto')->distinct()->get();
            return response()->json($products);
        }
    }

    public function getFltYear(Request $request)
    {
        if ($request->ajax()) {
            $years = DB::table('tbl_olap')->select('año')->distinct()->get();
            return response()->json($years);
        }
    }

    public function getFltMonth(Request $request)
    {
        $this->sql = "select distinct mes from tbl_olap "
                        . "order by case mes 
                                    when 'ENERO' then 1 
                                    when 'FEBRERO' then 2 
                                    when 'MARZO' then 3 
                                    when 'ABRIL' then 4 
                                    when 'MAYO' then 5 
                                    when 'JUNIO' then 6 
                                    when 'JULIO' then 7
                                    when 'AGOSTO' then 8
                                    when 'SEPTIEMBRE' then 9
                                    when 'OCTUBRE' then 10
                                    when 'NOVIEMBRE' then 11
                                    when 'DICIEMBRE' then 12
                                    end";
        if ($request->ajax()) {
            $months = DB::select($this->sql);
            return response()->json($months);
        }
    }

    public function getFltCountry(Request $request)
    {
        if ($request->ajax()) {
            $countries = DB::select('select distinct pais from tbl_olap');
            return response()->json($countries);
        }
    }

    public function getDataMaxMonthContry(Request $request)
    {
        if ($request->ajax()) {
            if (!is_null($request->condition)) {
                foreach ($request->condition as $condition) {
                    $this->sql = $this->sql . $condition . " and ";
                }
                $this->sql = substr($this->sql, 0, strlen($this->sql) - 5);
                $this->sql = "select tmi.pais
                                  ,tme.max_per_expo
                                  ,tmi.max_per_impo
                                from (select distinct pais
                                      ,maximo_periodo max_per_impo
                                    from tbl_olap
                                    where intercambio = 'IMPORT' and " . $this->sql . ") tmi
                                join (select distinct pais
                                      ,maximo_periodo max_per_expo
                                    from tbl_olap
                                    where intercambio = 'EXPORT' and " . $this->sql . ") tme using(pais)";
            } else {
                $this->sql = "select tmi.pais
                              ,tme.max_per_expo
                              ,tmi.max_per_impo
                            from (select distinct pais
                                  ,maximo_periodo max_per_impo
                                from tbl_olap
                                where intercambio = 'IMPORT') tmi
                            join (select distinct pais
                                  ,maximo_periodo max_per_expo
                                from tbl_olap
                                where intercambio = 'EXPORT') tme using(pais);";
            }
            $maxMonthCountries = DB::select($this->sql);
            return json_encode($maxMonthCountries);
        }
    }

    public function getDataMonthCant(Request $request)
    {
        if ($request->ajax()) {
            if (!is_null($request->condition)) {
                foreach ($request->condition as $condition) {
                    $this->sql = $this->sql . $condition . " and ";
                }
                $this->sql = substr($this->sql, 0, strlen($this->sql) - 5);
                $this->sql = "select mes, count(1) cant from tbl_olap where " . $this->sql . "group by 1;";
            } else {
                $this->sql = "select mes, count(1) cant from tbl_olap group by 1;";
            }
            $monthCant = DB::select($this->sql);
            return json_encode($monthCant);
        }
    }

    public function getDataEfecAnalyst(Request $request)
    {
        if ($request->ajax()) {
            if (!is_null($request->condition)) {
                foreach ($request->condition as $condition) {
                    $this->sql = $this->sql . $condition . " and ";
                }
                $this->sql = substr($this->sql, 0, strlen($this->sql) - 5);
                $this->sql = "select analista
                                  ,count( fecha_llegada ) asignadas
                                  ,count( fecha_carga ) cargadas
                                  ,cast(count(fecha_carga)/count( fecha_llegada ) * 100 as decimal(13, 2)) porc
                                from tbl_olap where " . $this->sql . "group by 1;";
            } else {
                $this->sql = "select analista
                              ,count( fecha_llegada ) asignadas
                              ,count( fecha_carga ) cargadas
                              ,cast(count(fecha_carga)/count( fecha_llegada ) * 100 as decimal(13, 2)) porc
                            from tbl_olap
                            group by 1";
            }
            $efecAnalyst = DB::select($this->sql);
            return json_encode($efecAnalyst);
        }
    }

    public function getDataDbsInProgress(Request $request){

        if ($request->ajax()) {
            $this->sql = "SELECT DISTINCT base
                              ,date(fecha_llegada) fecha_llegada
                              ,analista
                              ,sum(dias_de_retraso) dias_de_retraso
                            FROM tbl_olap 
                            WHERE fecha_carga IS NULL 
                            GROUP BY 1,2,3
                            ORDER BY 4 DESC;";

            $countriesInProgress = DB::select($this->sql);
            return json_encode($countriesInProgress);
        }
    }
}
