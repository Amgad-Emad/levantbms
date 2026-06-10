<!doctype html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
<body style="margin:0;background:#f2ede3;font-family:Arial,Helvetica,sans-serif;color:#0a1224;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f2ede3;padding:24px 0;">
    <tr><td align="center">
      <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:14px;overflow:hidden;border:1px solid #e3dccc;">
        <tr><td style="background:#0a1f3d;padding:22px 28px;">
          <span style="color:#fff;font-size:18px;font-weight:bold;">Levant<span style="color:#f58220;">BMS</span></span>
          <span style="color:#cdd6e6;font-size:12px;display:block;margin-top:4px;">New website enquiry</span>
        </td></tr>
        <tr><td style="padding:28px;">
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;line-height:1.6;">
            @php
              $rows = [
                'Name'    => $lead->name,
                'Email'   => $lead->email,
                'Phone'   => $lead->phone,
                'Company' => $lead->company,
                'Topic'   => $lead->topic,
              ];
            @endphp
            @foreach ($rows as $label => $value)
              @if (filled($value))
                <tr>
                  <td style="padding:8px 0;width:120px;color:#5b6982;vertical-align:top;">{{ $label }}</td>
                  <td style="padding:8px 0;color:#0a1224;font-weight:600;">{{ $value }}</td>
                </tr>
              @endif
            @endforeach
          </table>
          @if (filled($lead->message))
            <div style="margin-top:20px;padding-top:20px;border-top:1px solid #eee;">
              <div style="color:#5b6982;font-size:12px;text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px;">Message</div>
              <div style="font-size:14px;line-height:1.7;white-space:pre-line;">{{ $lead->message }}</div>
            </div>
          @endif
          <div style="margin-top:24px;font-size:12px;color:#9aa3b3;">
            Submitted {{ optional($lead->created_at)->format('d M Y, H:i') }} · Language: {{ strtoupper($lead->locale ?? '') }} · IP: {{ $lead->ip }}
          </div>
        </td></tr>
      </table>
      <div style="color:#9aa3b3;font-size:11px;margin-top:16px;">This lead is also saved in your dashboard under Leads.</div>
    </td></tr>
  </table>
</body>
</html>
