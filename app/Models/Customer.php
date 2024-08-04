<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Model
{
    use HasFactory, Notifiable;

    protected $connection = 'vault';
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'phone_number',
        'profile_image',
        'has_set_transaction_pin',
        'has_set_security_question',
        'has_set_payout_account'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'email_verified' => 'boolean',
        'password' => 'hashed',
        'has_set_transaction_pin' => 'boolean',
        'has_set_security_question' => 'boolean',
        'has_set_payout_account' => 'boolean',
        'bvn_verified' => 'boolean',
    ];

    protected $with = ["walletBalances", 'walletBalances.wallet', 'securityQuestion:id,user_id,security_question_id','bank','virtualAccount'];
    protected $appends = ['profile_image_url','name', 'wallet_balance','savings_balance', 'interest_balance'];

    public function getNameAttribute()
    {
        return ucwords("{$this->first_name} {$this->last_name}");
    }


    public function getProfileImageUrlAttribute()
    {   
            return $this->profile_image !== null ? asset('storage/'.$this->profile_image) : '';
    }


    
    public function transactionPin()
    {
        return $this->hasOne(TransactionPin::class, 'user_id');
    }

    public function investmentClub()
    {
        return $this->hasOne(InvestmentClub::class, 'user_id')->where('status', 'active');
    }

    public function getWalletBalanceAttribute()
    {   
        $wallet = Wallet::where('name', 'VAULT')->first();
        $balance = $this->walletBalances()->wallet('VAULT')->sum('available_balance');
        return $balance ?? 0.00;
    }

    public function getSavingsBalanceAttribute()
    {   
        $balance = $this->savings->sum('balance.available_balance');
        return $balance ?? 0.00;
    }

    public function getInterestBalanceAttribute()
    {   
        $balance = WalletBalance::whereUserId($this->id)->where('wallet_id', Wallet::where('type', 'CASHBACK')->first()->id);
        // $balance = $this->walletBalances()->wallet('CASHBACK')->sum('available_balance');
        return $balance->sum('available_balance') ?? 0.00;
    }

    public function virtualAccount()
    {
        return $this->hasOne(VirtualAccount::class, 'user_id');
    }

    public function securityQuestion()
    {
        return $this->hasOne(UserSecurityQuestion::class, 'user_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');

    }
    public function cards()
    {
        return $this->hasMany(UserCard::class, 'user_id');
    }

    public function bank()
    {
        return $this->hasOne(UserBank::class, 'user_id');
    }

    public function walletBalances()
    {
        return $this->hasMany(WalletBalance::class, 'user_id');
    }

    public function investmentPayoutWallets()
    {
        return $this->hasMany(UserInvestmentWallet::class, 'user_id');
    }
    public function savings()
    {
        return $this->hasMany(Savings::class, 'user_id');
    }


    public function groupSavings()
    {
        return $this->hasMany(GroupSavings::class, 'user_id');
    }

    public function scopeSearch($query, $search_term)
    {
        $search_term = "{$search_term}*";
        $query->whereRaw('MATCH (first_name, last_name, middle_name, bvn, bvn_phone_number, nin, email, phone_number) AGAINST (? IN BOOLEAN MODE)' , array($search_term));
    }
}
