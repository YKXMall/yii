<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cart_item".
 *
 * @property integer $id
 * @property integer $cart_id
 * @property integer $product_id
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $status
 * @property integer $updated_at
 * @property integer $updated_by
 * @property integer $count
 * @property integer $is_ordered
 * @property integer $is_selected
 * @property integer $cookie_id
 * @property integer $app_cart_cookie_id
 *
 * @property Cart $cart
 * @property Product $product
 * @property CartItemAttr[] $cartItemAttrs
 */
class CartItem extends ETActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cart_id', 'product_id', 'user_id', 'created_at', 'created_by', 'status', 'updated_at', 'updated_by', 'count', 'is_ordered', 'is_selected', 'cookie_id', 'app_cart_cookie_id'], 'integer'],
            [['status', 'is_ordered', 'is_selected'], 'required'],
            [['cart_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cart::className(), 'targetAttribute' => ['cart_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cart_id' => Yii::t('app', 'Cart ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'status' => Yii::t('app', 'Status'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'count' => Yii::t('app', 'Count'),
            'is_ordered' => Yii::t('app', 'Is Ordered'),
            'is_selected' => Yii::t('app', 'Is Selected'),
            'cookie_id' => Yii::t('app', 'Cookie ID'),
            'app_cart_cookie_id' => Yii::t('app', 'App Cart Cookie ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCart()
    {
        return $this->hasOne(Cart::className(), ['id' => 'cart_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartItemAttrs()
    {
        return $this->hasMany(CartItemAttr::className(), ['item_id' => 'id']);
    }
}