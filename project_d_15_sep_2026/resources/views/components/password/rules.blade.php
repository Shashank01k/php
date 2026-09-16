<style>
    .rule-item {
        font-family: sans-serif;
        font-size: 14px;
        margin: 6px 0;
        color: #d9534f;
        transition: color 0.2s ease;
    }

    .rule-item.valid {
        color: #5cb85c;
    }

    .icon {
        font-weight: bold;
        display: inline-block;
        width: 18px;
    }
</style>

<div>
    <div id="checklist" style="margin-top: 15px;">

        <div class="rule-item" id="rule-min_length">
            <span class="icon">✕</span>
            At least 8 characters
        </div>

        <div class="rule-item" id="rule-max_length">
            <span class="icon">✕</span>
            Maximum 20 characters
        </div>

        <div class="rule-item" id="rule-uppercase">
            <span class="icon">✕</span>
            At least one uppercase letter (A-Z)
        </div>

        <div class="rule-item" id="rule-lowercase">
            <span class="icon">✕</span>
            At least one lowercase letter (a-z)
        </div>

        <div class="rule-item" id="rule-number">
            <span class="icon">✕</span>
            At least one number (0-9)
        </div>

        <div class="rule-item" id="rule-special_char">
            <span class="icon">✕</span>
            At least one special character (!@#$%^&*)
        </div>

        <div class="rule-item" id="rule-match_password">
            <span class="icon">✕</span>
            Password and confirm password match (Abc = Abc)
        </div>

    </div>
</div>