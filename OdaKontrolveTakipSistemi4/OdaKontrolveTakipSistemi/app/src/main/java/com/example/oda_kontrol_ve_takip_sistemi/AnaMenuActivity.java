package com.example.oda_kontrol_ve_takip_sistemi;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.example.oda_kontrol_ve_takip_sistemi.databinding.ActivityAnaMenuBinding;
import com.google.android.gms.tasks.OnFailureListener;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.firebase.firestore.FirebaseFirestore;

import java.util.HashMap;
import java.util.Map;

public class AnaMenuActivity extends AppCompatActivity {

    public ActivityAnaMenuBinding binding;
    FirebaseFirestore db;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding=ActivityAnaMenuBinding.inflate(getLayoutInflater());
        EdgeToEdge.enable(this);
        setContentView(binding.getRoot());
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });
        db = FirebaseFirestore.getInstance();

        String[] odalar={"Oda Numarası Seçin...","100","101","102","103","104","105","106","107","108","109","110"};
        String[] gunler ={"Gün Seçiniz...","01/10/2025","02/10/2025","03/10/2025","04/10/2025","05/10/2025","06/10/2025","07/10/2025","08/10/2025","09/10/2025","10/10/2025"};
        String[] saatler={"Lütfen bir saat aralığı seçiniz...","13:00","13:30","15:00","15:30"};
        String[] secenek={"Lütfen Seçim Yapınız...","Yapıldı","Yapılmadı"};
        ArrayAdapter<String>adapter=new ArrayAdapter<String>(this, com.google.android.material.R.layout.support_simple_spinner_dropdown_item,odalar);
        ArrayAdapter<String>adapter2=new ArrayAdapter<String>(this, androidx.appcompat.R.layout.support_simple_spinner_dropdown_item,gunler);
        ArrayAdapter<String>adapter3=new ArrayAdapter<String>(this, com.google.android.material.R.layout.support_simple_spinner_dropdown_item,saatler);
        ArrayAdapter<String>adapter4=new ArrayAdapter<String>(this, com.google.android.material.R.layout.support_simple_spinner_dropdown_item,secenek);
        binding.spinner.setAdapter(adapter);
        binding.spinner2.setAdapter(adapter2);
        binding.spinner3.setAdapter(adapter3);
        binding.spinner4.setAdapter(adapter4);
        binding.spinner5.setAdapter(adapter4);
        binding.spinner6.setAdapter(adapter4);
        binding.spinner7.setAdapter(adapter4);
        binding.spinner8.setAdapter(adapter4);
        binding.spinner9.setAdapter(adapter4);
        binding.spinner10.setAdapter(adapter4);
        binding.spinner11.setAdapter(adapter4);
        binding.spinner12.setAdapter(adapter4);
        binding.spinner13.setAdapter(adapter4);
    }
    public void veri_ekle (View view){
        // Create a new user with a first and last name
        Map<String, Object> data = new HashMap<>();
        data.put("Oda Numarası",binding.spinner.getSelectedItem().toString());
        data.put("Günler",binding.spinner2.getSelectedItem().toString());
        data.put("Saatler",binding.spinner3.getSelectedItem().toString());
        data.put("Klozet Temizliği",binding.spinner4.getSelectedItem().toString());
        data.put("Lavabo Temizliği",binding.spinner5.getSelectedItem().toString());
        data.put("Musluk Temizliği",binding.spinner6.getSelectedItem().toString());
        data.put("Ayna Temizliği",binding.spinner7.getSelectedItem().toString());
        data.put("Kapı Kolu Temizliği",binding.spinner8.getSelectedItem().toString());
        data.put("Zemin Temizliği",binding.spinner9.getSelectedItem().toString());
        data.put("Çöp Torbasının Temizlği",binding.spinner10.getSelectedItem().toString());
        data.put("Oda İçi Temizliği",binding.spinner11.getSelectedItem().toString());
        data.put("Yatak Düzeni",binding.spinner12.getSelectedItem().toString());
        data.put("Oda Tefrişatı Düzeni",binding.spinner13.getSelectedItem().toString());

// Add a new document with a generated ID
        db.collection("Kayıtlar").document(binding.spinner.getSelectedItem().toString())
                .set(data)
                .addOnSuccessListener(new OnSuccessListener<Void>() {
                    @Override
                    public void onSuccess(Void unused) {
                        Toast.makeText(AnaMenuActivity.this, "Veri ekleme işlemi başarılı...", Toast.LENGTH_SHORT).show();
                    }
                })
                .addOnFailureListener(new OnFailureListener() {
                    @Override
                    public void onFailure(@NonNull Exception e) {
                        Toast.makeText(AnaMenuActivity.this, "Veri ekleme işlemi başarısız!!", Toast.LENGTH_SHORT).show();
                    }
                });
    }
    public void veri_sil (View view){
        db.collection("Kayıtlar").document(binding.spinner.getSelectedItem().toString())
                .delete()
                .addOnSuccessListener(new OnSuccessListener<Void>() {
                    @Override
                    public void onSuccess(Void unused) {
                        Toast.makeText(AnaMenuActivity.this, "Veri silme işlemi başarılı...", Toast.LENGTH_SHORT).show();
                    }
                })
                .addOnFailureListener(new OnFailureListener() {
                    @Override
                    public void onFailure(@NonNull Exception e) {
                        Toast.makeText(AnaMenuActivity.this, "Veri silme işlemi başarısız!!", Toast.LENGTH_SHORT).show();
                    }
                });
    }
    public void veri_güncelle (View view){
        Map<String, Object> data = new HashMap<>();
        data.put("Oda Numarası",binding.spinner.getSelectedItem().toString());
        data.put("Günler",binding.spinner2.getSelectedItem().toString());
        data.put("Saatler",binding.spinner3.getSelectedItem().toString());
        data.put("Klozet Temizliği",binding.spinner4.getSelectedItem().toString());
        data.put("Lavabo Temizliği",binding.spinner5.getSelectedItem().toString());
        data.put("Musluk Temizliği",binding.spinner6.getSelectedItem().toString());
        data.put("Ayna Temizliği",binding.spinner7.getSelectedItem().toString());
        data.put("Kapı Kolu Temizliği",binding.spinner8.getSelectedItem().toString());
        data.put("Zemin Temizliği",binding.spinner9.getSelectedItem().toString());
        data.put("Çöp Torbasının Temizlği",binding.spinner10.getSelectedItem().toString());
        data.put("Oda İçi Temizliği",binding.spinner11.getSelectedItem().toString());
        data.put("Yatak Düzeni",binding.spinner12.getSelectedItem().toString());
        data.put("Oda Tefrişatı Düzeni",binding.spinner13.getSelectedItem().toString());
        db.collection("Kayıtlar").document(binding.spinner.getSelectedItem().toString())
                .update(data)
                .addOnSuccessListener(new OnSuccessListener<Void>() {
                    @Override
                    public void onSuccess(Void unused) {
                        Toast.makeText(AnaMenuActivity.this, "Veri silme işlemi başarılı...", Toast.LENGTH_SHORT).show();
                    }
                })
                .addOnFailureListener(new OnFailureListener() {
                    @Override
                    public void onFailure(@NonNull Exception e) {
                        Toast.makeText(AnaMenuActivity.this, "Veri silme işlemi başarısız!!", Toast.LENGTH_SHORT).show();
                    }
                });
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu,menu);
        return super.onCreateOptionsMenu(menu);
    }

    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) {
        if (item.getItemId()==R.id.menu_ayarlar) {
            Intent intent = new Intent(AnaMenuActivity.this, KullaniciActivity.class);
            startActivity(intent);
            finish();
        }
        if (item.getItemId()==R.id.menu_cikis) {
            finish();
        }
        return super.onOptionsItemSelected(item);
    }
}