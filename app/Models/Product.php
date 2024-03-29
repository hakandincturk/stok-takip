<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $code ean13 barcode
 * @property string $name
 * @property string $slug
 * @property int|null $categoryId
 * @property int|null $brandId
 * @property int $unitId
 * @property int $taxRate
 * @property int $buyingPrice
 * @property int $salesPrice
 * @property string|null $description
 * @property int $followStock 0:hayır, 1:evet
 * @property int $criticStockAlert -1 ise yapılmayacak
 * @property string|null $image
 * @property int $isActive
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBuyingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCriticStockAlert($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFollowStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSalesPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTaxRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property float|null $sellingPrice
 * @property-read \App\Models\Category|null $categoryDetails
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSellingPrice($value)
 */
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "code",
        "name",
        "slug",
        "categoryId",
        "brandId",
        "unitId",
        "taxRate",
        "buyingPrice",
        "sellingPrice",
        "description",
        "followStock",
        "criticStockAlert",
        "image",
        "isActive",
    ];

    protected $appends = ['CalcuteStockCount', 'StockMobility', 'ProfitAndLoss'];

    public function categoryDetails(){
        return $this->hasOne('App\Models\Category', 'id', 'categoryId');
    }

    public function unitDetails(){
        return $this->hasOne('App\Models\Unit', 'id', 'unitId');
    }

    public function stocks(){
        return $this->hasMany('App\Models\Stock', 'productId', 'id');
    }

    public function getCalcuteStockCountAttribute(){
        $sumInputTotal = $this->stocks()->where('isActive', 1)->where('inOrOut', 1)->where('date', '<', date('Y-m-d H:i:s'))->sum('sumProductCount');
        $sumOutputTotal = $this->stocks()->where('isActive', 1)->where('inOrOut', 0)->where('date', '<', date('Y-m-d H:i:s'))->sum('sumProductCount');
        return $sumInputTotal - $sumOutputTotal;
    }

    public function getStockMobilityAttribute(){
        $stockMobility = new \stdClass();
        $stockMobility->in = $this->stocks()->where('isActive', 1)->where('inOrOut', 1)->get();
        $stockMobility->out = $this->stocks()->where('isActive', 1)->where('inOrOut', 0)->get();
        return $stockMobility;
    }

    public function getProfitAndLossAttribute(){
        $sumProfit = $this->stocks()->where('isActive', 1)->where('date', '<', date('Y-m-d H:i:s'))->where('inOrOut', 0)->sum('sumTradingVolume');
        $sumLoss = $this->stocks()->where('isActive', 1)->where('date', '<', date('Y-m-d H:i:s'))->where('inOrOut', 1)->sum('sumTradingVolume');
        return $sumProfit - $sumLoss;
    }

}
